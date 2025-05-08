@extends('layouts.app')

@section('titulo','Detalhes da Categoria')
@section('conteudo')
  <h1>Detalhes da Categoria</h1>
  <ul class="list-group mb-3">
    <li class="list-group-item"><strong>ID:</strong> {{ $categoria->id }}</li>
    <li class="list-group-item"><strong>Nome:</strong> {{ $categoria->nome }}</li>
    <li class="list-group-item"><strong>Categoria Pai:</strong> {{ $categoria->parent->nome ?? '-' }}</li>
  </ul>
  <div class="d-flex gap-2">
    <a href="{{ route('categorias.edit',$categoria) }}" class="btn btn-warning w-100">Editar</a>
    <form action="{{ route('categorias.destroy',$categoria) }}" method="POST" class="w-100">
      @csrf @method('DELETE')
      <button class="btn btn-danger w-100" onclick="return confirm('Excluir esta categoria?')">Excluir</button>
    </form>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary w-100">Voltar</a>
  </div>
@endsection