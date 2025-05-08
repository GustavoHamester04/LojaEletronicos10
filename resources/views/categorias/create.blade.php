@extends('layouts.app')

@section('titulo','Nova Categoria')
@section('conteudo')
  <h1>Nova Categoria</h1>

  <form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}">
      @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label for="categoria_pai" class="form-label">Categoria Pai</label>
      <select name="categoria_pai" id="categoria_pai" class="form-select @error('categoria_pai') is-invalid @enderror">
        <option value="">Nenhuma</option>
        @foreach($pais as $p)
          <option value="{{ $p->id }}" @selected(old('categoria_pai') == $p->id)>{{ $p->nome }}</option>
        @endforeach
      </select>
      @error('categoria_pai')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary w-100">Salvar</button>
      <a href="{{ route('categorias.index') }}" class="btn btn-secondary w-100">Cancelar</a>
    </div>
  </form>
@endsection