@extends('layouts.app')

@section('titulo', 'Editar Foto')
@section('conteudo')
<h1>Editar Foto</h1>

<form action="{{ route('fotos.update', $foto) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="produto_id" class="form-label">Produto</label>
    <select name="produto_id" id="produto_id" class="form-select">
      @foreach($produtos as $id => $nome)
        <option value="{{ $id }}" @selected($foto->produto_id == $id)>{{ $nome }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="arquivo" class="form-label">Nova Foto (opcional)</label>
    <input type="file" name="arquivo" id="arquivo" class="form-control">
    <small class="text-muted">Deixe em branco para manter a foto atual.</small>
  </div>

  <button type="submit" class="btn btn-warning">Atualizar Foto</button>
</form>
@endsection
