<?php
namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Cidade;
use App\Models\Cliente;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::with(['cidade','cliente'])->get();
        return view('enderecos.index', compact('enderecos'));
    }

    public function create()
    {
        $cidades = Cidade::all();
        $clientes = Cliente::all();
        return view('enderecos.create', compact('cidades','clientes'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'descricao'  => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero'     => 'required|string|max:50',
            'bairro'     => 'required|string|max:100',
            'cidade_id'  => 'required|exists:cidades,id',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Endereco::create($dados);

        return redirect()
            ->route('enderecos.index')
            ->with('success','Endereço cadastrado com sucesso!');
    }

    public function show(Endereco $endereco)
    {
        return view('enderecos.show', compact('endereco'));
    }

    public function edit(Endereco $endereco)
    {
        $cidades = Cidade::all();
        $clientes = Cliente::all();
        return view('enderecos.edit', compact('endereco','cidades','clientes'));
    }

    public function update(Request $request, Endereco $endereco)
    {
        $dados = $request->validate([
            'descricao'  => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero'     => 'required|string|max:50',
            'bairro'     => 'required|string|max:100',
            'cidade_id'  => 'required|exists:cidades,id',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $endereco->update($dados);

        return redirect()
            ->route('enderecos.index')
            ->with('success','Endereço atualizado com sucesso!');
    }

    public function destroy(Endereco $endereco)
    {
        $endereco->delete();
        return redirect()
            ->route('enderecos.index')
            ->with('success','Endereço excluído com sucesso!');
    }
}
