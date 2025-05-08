<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:14|unique:clientes,cpf',
        'rg' => 'nullable|string|max:20',
        'data_nascimento' => 'required|date',
        'telefone' => 'nullable|string|max:20',
        'email' => 'required|email|unique:clientes,email',
        'senha' => 'required|string|min:6',
    ]);

    Cliente::create($data);

    return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
}

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $cliente->id,
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
