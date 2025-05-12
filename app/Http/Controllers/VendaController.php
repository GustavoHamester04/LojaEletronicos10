<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with('cliente', 'endereco')->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $produtos = Produto::all();
        $enderecos = Auth::user()->enderecos;
        $clientes = Cliente::all(); // Adicionado para buscar todos os clientes
        return view('vendas.create', compact('produtos', 'enderecos', 'clientes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id', // Validação para cliente_id
            'endereco_id' => 'required|exists:enderecos,id',
            'produtos' => 'required|array',
            'quantidades' => 'required|array',
        ]);

        $venda = Venda::create([
            'cliente_id' => $data['cliente_id'], // Utilizando o cliente selecionado
            'endereco_id' => $data['endereco_id'],
            'valor_total' => 0,
        ]);

        $total = 0;
        foreach ($data['produtos'] as $produtoId) {
            $qtd = intval($data['quantidades'][$produtoId] ?? 0);
            if ($qtd > 0) {
                $produto = Produto::findOrFail($produtoId);
                $subtotal = $produto->valor * $qtd;
                $venda->produtos()->attach($produtoId, [
                    'quantidade' => $qtd,
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }
        }

        $venda->update(['valor_total' => $total]);

        return redirect()->route('vendas.index')
            ->with('success', 'Venda registrada com sucesso!');
    }

    public function show(Venda $venda)
    {
        $venda->load('produtos', 'endereco', 'cliente');
        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $produtos = Produto::all();
        $enderecos = Auth::user()->enderecos;
        $clientes = Cliente::all(); // Adicionado para edição
        return view('vendas.edit', compact('venda', 'produtos', 'enderecos', 'clientes'));
    }

    public function update(Request $request, Venda $venda)
    {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id', // Validação para cliente_id
            'endereco_id' => 'required|exists:enderecos,id',
            'produtos' => 'required|array',
            'quantidades' => 'required|array',
        ]);

        $venda->produtos()->detach(); // Limpar antigos produtos da venda

        $total = 0;
        foreach ($data['produtos'] as $produtoId) {
            $qtd = intval($data['quantidades'][$produtoId] ?? 0);
            if ($qtd > 0) {
                $produto = Produto::findOrFail($produtoId);
                $subtotal = $produto->valor * $qtd;
                $venda->produtos()->attach($produtoId, [
                    'quantidade' => $qtd,
                    'subtotal' => $subtotal,
                ]);
                $total += $subtotal;
            }
        }

        $venda->update([
            'cliente_id' => $data['cliente_id'], // Atualizando o cliente
            'endereco_id' => $data['endereco_id'],
            'valor_total' => $total,
        ]);

        return redirect()->route('vendas.index')
            ->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index')
            ->with('success', 'Venda excluída.');
    }
}
