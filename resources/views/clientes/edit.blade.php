@extends('layouts.app')

@section('titulo', 'Editar Cliente')

@section('conteudo')
    <h1>Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')

        @include('clientes.partials.form', ['cliente' => $cliente])

        <button type="submit" class="btn btn-warning">Atualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection