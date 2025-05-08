<!-- resources/views/cidades/index.blade.php -->
@extends('layouts.app')

@section('titulo', 'Lista de Cidades')

@section('conteudo')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1>Cidades</h1>
  <a href="{{ route('cidades.create') }}" class="btn btn-success">Nova Cidade</a>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Estado (UF)</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @forelse($cidades as $cidade)
      <tr>
        <td>{{ $cidade->id }}</td>
        <td>{{ $cidade->nome }}</td>
        <td>{{ $cidade->estado }}</td>
        <td>
          <a href="{{ route('cidades.show', $cidade) }}" class="btn btn-sm btn-primary">Ver</a>
          <a href="{{ route('cidades.edit', $cidade) }}" class="btn btn-sm btn-warning">Editar</a>
          <form action="{{ route('cidades.destroy', $cidade) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Confirma exclusão desta cidade?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Excluir</button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4" class="text-center">Nenhuma cidade cadastrada.</td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
