@extends('layouts.app')

@section('titulo', 'Detalhes da Foto')
@section('conteudo')
    <h1>Detalhes da Foto</h1>
    <div class="mb-3">
        <strong>ID:</strong> {{ $foto->id }}
    </div>
    <div class="mb-3">
        <strong>Produto:</strong> {{ $foto->produto->nome }}
    </div>
    <div class="mb-3">
        <strong>Imagem:</strong><br>
        <img src="{{ asset('storage/'.$foto->arquivo) }}" alt="Foto do Produto" width="150">
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('fotos.edit', $foto) }}" class="btn btn-warning w-100">Editar</a>
        <form action="{{ route('fotos.destroy', $foto) }}" method="POST" class="w-100">
            @csrf @method('DELETE')
            <button class="btn btn-danger w-100" onclick="return confirm('Excluir esta foto?')">Excluir</button>
        </form>
        <a href="{{ route('fotos.index') }}" class="btn btn-secondary w-100">Voltar</a>
    </div>
@endsection