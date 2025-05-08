@extends('layouts.app')

@section('titulo','Detalhes do Produto')
@section('conteudo')
  <h1>Detalhes do Produto</h1>
  <ul class="list-group mb-3">
    <li class="list-group-item"><strong>ID:</strong> {{ $produto->id }}</li>
    <li class="list-group-item"><strong>Nome:</strong> {{ $produto->nome }}</li>
    <li class="list-group-item"><strong>Descrição:</strong> {{ $produto->descricao }}</li>
    <li class="list-group-item"><strong>Estoque:</strong> {{ $produto->estoque }}</li>
    <li class="list-group-item"><strong>Valor:</strong> R$ {{ number_format($produto->valor,2,',','.') }}</li>
    <li class="list-group-item"><strong>Categoria:</strong> {{ $produto->categoria->nome }}</li>
  </ul>
  <div class="d-flex gap-2">
    <a href="{{ route('produtos.edit',$produto) }}" class="btn btn-warning w-100">Editar</a>
    <form action="{{ route('produtos.destroy',$produto) }}" method="POST" class="w-100">
      @csrf @method('DELETE')
      <button class="btn btn-danger w-100" onclick="return confirm('Excluir este produto?')">Excluir</button>
    </form>
    <a href="{{ route('produtos.index') }}" class="btn btn-secondary w-100">Voltar</a>
  </div>
@endsection
