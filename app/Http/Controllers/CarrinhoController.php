<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        $total = array_sum(array_map(function ($item) {
            return $item['subtotal'];
        }, $carrinho));

        return view('carrinho.index', compact('carrinho', 'total'));
    }

    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
            $carrinho[$id]['subtotal'] = $carrinho[$id]['quantidade'] * $produto->valor;
        } else {
            $carrinho[$id] = [
                'nome' => $produto->nome,
                'valor' => $produto->valor,
                'quantidade' => 1,
                'subtotal' => $produto->valor,
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho.index')->with('success', 'Produto removido!');
    }

    public function limpar()
    {
        session()->forget('carrinho');
        return redirect()->route('carrinho.index')->with('success', 'Carrinho limpo!');
    }

    public function finalizar(Request $request)
{
    $carrinho = session()->get('carrinho', []);

    if (empty($carrinho)) {
        return redirect()->back()->with('error', 'O carrinho está vazio.');
    }

    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Faça login para finalizar a compra.');
    }

    $cliente = Auth::user()->load('enderecos');

    if ($cliente->enderecos->isEmpty()) {
        return redirect()->route('enderecos.create')->with('error', 'Nenhum endereço encontrado. Cadastre um endereço primeiro.');
    }

    $endereco = $cliente->enderecos->first();

    $venda = Venda::create([
        'cliente_id'  => $cliente->id,
        'endereco_id' => $endereco->id,
        'valor_total' => 0,
    ]);

    $valorTotal = 0;

    foreach ($carrinho as $id => $item) {
        $produto = Produto::findOrFail($id);
        $subtotal = $produto->valor * $item['quantidade'];

        $venda->produtos()->attach($produto->id, [
            'quantidade' => $item['quantidade'],
            'subtotal'   => $subtotal,
        ]);

        $valorTotal += $subtotal;
    }

    $venda->update(['valor_total' => $valorTotal]);
    session()->forget('carrinho');

    return redirect()->route('vendas.index')->with('success', 'Compra finalizada com sucesso!');
}
}
