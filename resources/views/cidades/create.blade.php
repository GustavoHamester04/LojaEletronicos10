<!-- resources/views/cidades/create.blade.php -->
@extends('layouts.app')

@section('titulo', 'Nova Cidade')

@section('conteudo')
  <h1>Nova Cidade</h1>

  <form action="{{ route('cidades.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" name="nome" id="nome"
             class="form-control @error('nome') is-invalid @enderror"
             value="{{ old('nome') }}">
      @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="estado" class="form-label">Estado (UF)</label>
      <input type="text" name="estado" id="estado"
             class="form-control @error('estado') is-invalid @enderror"
             value="{{ old('estado') }}">
      @error('estado')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="{{ route('cidades.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
@endsection
