@extends('layouts.app')
@section('titulo','Vendas')
@section('conteudo')
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between mb-3">
  <h1>Vendas</h1>
  <a href="{{ route('vendas.create') }}" class="btn btn-success">Nova Venda</a>
</div>

<table class="table">
  <thead><tr>
    <th>ID</th><th>Cliente</th><th>Endereço</th><th>Total</th><th>Ações</th>
  </tr></thead>
  <tbody>
  @foreach($vendas as $v)
    <tr>
      <td>{{ $v->id }}</td>
      <td>{{ $v->cliente->name }}</td>
      <td>{{ $v->endereco->descricao }}</td>
      <td>R$ {{ number_format($v->valor_total,2,',','.') }}</td>
      <td>
        <a href="{{ route('vendas.show',$v) }}" class="btn btn-sm btn-primary">Ver</a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
