@extends('layouts.app')

@section('titulo', 'Produtos')
@section('conteudo')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Produtos</h1>
        <a href="{{ route('produtos.create') }}" class="btn btn-success">Novo Produto</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Estoque</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produtos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nome }}</td>
                    <td>{{ $p->categoria->nome }}</td>
                    <td>{{ $p->estoque }}</td>
                    <td>R$ {{ number_format($p->valor, 2, ',', '.') }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('produtos.show', $p) }}" class="btn btn-sm btn-primary">Ver</a>
                        <a href="{{ route('produtos.edit', $p) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('produtos.destroy', $p) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Excluir este produto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Sem produtos cadastrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $produtos->links() }}
@endsection