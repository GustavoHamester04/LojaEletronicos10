<!-- resources/views/cidades/show.blade.php -->
@extends('layouts.app')

@section('titulo', 'Detalhes da Cidade')

@section('conteudo')
  <h1>Detalhes da Cidade</h1>

  <div class="card mb-4">
    <div class="card-body">
      <p><strong>ID:</strong> {{ $cidade->id }}</p>
      <p><strong>Nome:</strong> {{ $cidade->nome }}</p>
      <p><strong>Estado (UF):</strong> {{ $cidade->estado }}</p>
    </div>
  </div>

  <a href="{{ route('cidades.edit', $cidade) }}" class="btn btn-warning">Editar</a>

  <form action="{{ route('cidades.destroy', $cidade) }}" method="POST"
        class="d-inline" onsubmit="return confirm('Deseja realmente excluir?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">Excluir</button>
  </form>

  <a href="{{ route('cidades.index') }}" class="btn btn-secondary">Voltar à Lista</a>
@endsection
