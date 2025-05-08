@extends('layouts.app')

@section('titulo', 'Cadastrar Fotos do Produto')

@section('conteudo')
    <h1>Cadastrar Fotos</h1>

    <form action="{{ route('fotos.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        
        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select name="produto_id" id="produto_id" class="form-select @error('produto_id') is-invalid @enderror">
                <option value="">Selecione um produto</option>
                @foreach($produtos as $id => $nome)
                    <option value="{{ $id }}" {{ old('produto_id') == $id ? 'selected' : '' }}>
                        {{ $nome }}
                    </option>
                @endforeach
            </select>
            @error('produto_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="fotos" class="form-label">Fotos (máximo 5)</label>
            <input type="file" name="fotos[]" id="arquivo" class="form-control" multiple>
            @error('fotos')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('fotos.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Salvar</button>
            <a href="{{ route('fotos.index') }}" class="btn btn-secondary w-100">Cancelar</a>
        </div>
    </form>
@endsection
