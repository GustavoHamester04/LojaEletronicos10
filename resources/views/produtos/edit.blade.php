@extends('layouts.app')

@section('titulo', 'Editar Produto')
@section('conteudo')
    <h1>Editar Produto</h1>
    <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                value="{{ old('nome', $produto->nome) }}">
            @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" rows="3"
                class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $produto->descricao) }}</textarea>
            @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="estoque" class="form-label">Estoque</label>
                <input type="number" name="estoque" id="estoque" min="0"
                    class="form-control @error('estoque') is-invalid @enderror"
                    value="{{ old('estoque', $produto->estoque) }}">
                @error('estoque')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" name="valor" id="valor" step="0.01"
                    class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor', $produto->valor) }}">
                @error('valor')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select name="categoria_id" id="categoria_id"
                    class="form-select @error('categoria_id') is-invalid @enderror">
                    @foreach($categorias as $id => $nome)
                        <option value="{{ $id }}" @selected(old('categoria_id', $produto->categoria_id) == $id)>{{ $nome }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning w-100">Atualizar</button>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary w-100">Cancelar</a>
        </div>
    </form>
@endsection