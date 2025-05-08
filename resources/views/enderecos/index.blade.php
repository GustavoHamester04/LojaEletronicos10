@extends('layouts.app')

@section('titulo','Endereços')

@section('conteudo')
  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Endereços</h1>
    <a href="{{ route('enderecos.create') }}"
       class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Adicionar Endereço
    </a>
  </div>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Logradouro</th>
        <th>Nº</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Cliente</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse($enderecos as $e)
        <tr>
          <td>{{ $e->id }}</td>
          <td>{{ $e->descricao }}</td>
          <td>{{ $e->logradouro }}</td>
          <td>{{ $e->numero }}</td>
          <td>{{ $e->bairro }}</td>
          <td>{{ $e->cidade->nome }} ({{ $e->cidade->estado }})</td>
          <td>{{ $e->cliente->nome }}</td>
          <td class="d-flex gap-1">
            <a href="{{ route('enderecos.show', $e) }}"
               class="btn btn-sm btn-primary" title="Ver">
              <i class="bi bi-eye"></i>
            </a>
            <a href="{{ route('enderecos.edit', $e) }}"
               class="btn btn-sm btn-warning" title="Editar">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('enderecos.destroy', $e) }}"
                  method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="btn btn-sm btn-danger"
                      onclick="return confirm('Excluir este endereço?')"
                      title="Excluir">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center">Sem endereços cadastrados.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
@endsection