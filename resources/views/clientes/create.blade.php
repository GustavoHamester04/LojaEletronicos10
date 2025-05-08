@extends('layouts.app')

@section('titulo', 'Cadastrar Cliente')

@section('conteudo')
    <h1>Cadastrar Cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        @include('clientes.partials.form')

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection