@extends('layouts.app')

@section('titulo', 'Fotos de Produtos')
@section('conteudo')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Fotos de Produtos</h1>
        <a href="{{ route('fotos.create') }}" class="btn btn-success">Nova Foto</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fotos as $foto)
                <tr>
                    <td>{{ $foto->id }}</td>
                    <td>{{ $foto->produto->nome }}</td>
                    <td>
                        @if($foto->arquivo)
                        <img src="{{ asset('storage/'.$foto->arquivo) }}" alt="Foto do Produto" width="150">
                        @else
                            Sem imagem
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('fotos.show', $foto) }}" class="btn btn-sm btn-primary">Ver</a>
                        <a href="{{ route('fotos.edit', $foto) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('fotos.destroy', $foto) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Excluir esta foto?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Sem fotos cadastradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $fotos->links() }}
@endsection