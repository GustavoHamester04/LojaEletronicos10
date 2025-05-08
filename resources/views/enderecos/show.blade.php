@extends('layouts.app')

@section('titulo','Detalhes do Endereço')

@section('conteudo')
  <h1>Detalhes do Endereço</h1>

  <div class="card mb-4">
    <div class="card-body">
      <p><strong>ID:</strong> {{ $endereco->id }}</p>
      <p><strong>Descrição:</strong> {{ $endereco->descricao }}</p>
      <p><strong>Logradouro:</strong> {{ $endereco->logradouro }}, nº {{ $endereco->numero }}</p>
      <p><strong>Bairro:</strong> {{ $endereco->bairro }}</p>
      <p><strong>Cidade:</strong> {{ $endereco->cidade->nome }} ({{ $endereco->cidade->estado }})</p>
      <p><strong>Cliente:</strong> {{ $endereco->cliente->nome }}</p>
    </div>
  </div>

  <div class="d-flex gap-2">
    <a href="{{ route('enderecos.edit', $endereco) }}"
       class="btn btn-warning w-100">
      <i class="bi bi-pencil"></i> Editar Endereço
    </a>

    <form action="{{ route('enderecos.destroy', $endereco) }}"
          method="POST" class="w-100">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger w-100"
              onclick="return confirm('Deseja excluir este endereço?')">
        <i class="bi bi-trash"></i> Excluir Endereço
      </button>
    </form>

    <a href="{{ route('enderecos.index') }}"
       class="btn btn-secondary w-100">
      <i class="bi bi-arrow-left-circle"></i> Voltar à Lista
    </a>
  </div>
@endsection