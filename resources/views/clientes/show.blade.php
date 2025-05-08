@extends('layouts.app')

@section('titulo', 'Detalhes do Cliente')

@section('conteudo')
    <h1>Detalhes do Cliente</h1>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Nome:</strong> {{ $cliente->nome }}</li>
        <li class="list-group-item"><strong>CPF:</strong> {{ $cliente->cpf }}</li>
        <li class="list-group-item"><strong>RG:</strong> {{ $cliente->rg }}</li>
        <li class="list-group-item"><strong>Data de Nascimento:</strong> {{ $cliente->data_nascimento }}</li>
        <li class="list-group-item"><strong>Telefone:</strong> {{ $cliente->telefone }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $cliente->email }}</li>
    </ul>

    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
@endsection