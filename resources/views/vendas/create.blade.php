@extends('layouts.app')
@section('titulo','Nova Venda')
@section('conteudo')
<h1>Nova Venda</h1>

<form action="{{ route('vendas.store') }}" method="POST">
  @csrf

  <div class="mb-3">
    <label class="form-label">Endereço</label>
    <select name="endereco_id" class="form-select">
      @foreach($enderecos as $e)
        <option value="{{ $e->id }}">{{ $e->descricao }} – {{ $e->cidade->nome }}</option>
      @endforeach
    </select>
  </div>

  <h4>Produtos</h4>
  @foreach($produtos as $p)
    <div class="row mb-2">
      <div class="col-md-6">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="produtos[]" value="{{ $p->id }}"
                 id="prod_{{ $p->id }}">
          <label class="form-check-label" for="prod_{{ $p->id }}">
            {{ $p->nome }} — R$ {{ number_format($p->valor,2,',','.') }}
          </label>
        </div>
      </div>
      <div class="col-md-2">
        <input type="number" name="quantidades[{{ $p->id }}]" class="form-control"
               placeholder="Qtd" min="0" value="0">
      </div>
    </div>
  @endforeach

  <button type="submit" class="btn btn-primary">Finalizar Compra</button>
  <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
