@extends('layouts.app')

@section('titulo','Novo Endereço')

@section('conteudo')
  <h1>Novo Endereço</h1>

  <form action="{{ route('enderecos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <input type="text" name="descricao" id="descricao"
             class="form-control @error('descricao') is-invalid @enderror"
             value="{{ old('descricao') }}">
      @error('descricao')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="logradouro" class="form-label">Logradouro</label>
      <input type="text" name="logradouro" id="logradouro"
             class="form-control @error('logradouro') is-invalid @enderror"
             value="{{ old('logradouro') }}">
      @error('logradouro')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="numero" class="form-label">Número</label>
      <input type="text" name="numero" id="numero"
             class="form-control @error('numero') is-invalid @enderror"
             value="{{ old('numero') }}">
      @error('numero')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="bairro" class="form-label">Bairro</label>
      <input type="text" name="bairro" id="bairro"
             class="form-control @error('bairro') is-invalid @enderror"
             value="{{ old('bairro') }}">
      @error('bairro')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="cidade_id" class="form-label">Cidade</label>
      <select name="cidade_id" id="cidade_id"
              class="form-select @error('cidade_id') is-invalid @enderror">
        <option value="">Selecione</option>
        @foreach($cidades as $c)
          <option value="{{ $c->id }}"
            @selected(old('cidade_id') == $c->id)>
            {{ $c->nome }} ({{ $c->estado }})
          </option>
        @endforeach
      </select>
      @error('cidade_id')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="cliente_id" class="form-label">Cliente</label>
      <select name="cliente_id" id="cliente_id"
              class="form-select @error('cliente_id') is-invalid @enderror">
        <option value="">Selecione</option>
        @foreach($clientes as $cli)
          <option value="{{ $cli->id }}"
            @selected(old('cliente_id') == $cli->id)>
            {{ $cli->nome }}
          </option>
        @endforeach
      </select>
      @error('cliente_id')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-check-circle"></i> Cadastrar Endereço
      </button>
      <a href="{{ route('enderecos.index') }}"
         class="btn btn-secondary w-100">
        <i class="bi bi-arrow-left-circle"></i> Voltar à Lista
      </a>
    </div>
  </form>
@endsection