@extends('layouts.app')

@section('titulo', 'Registrar')

@section('conteudo')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Registrar</div>
      <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
          @csrf

          {{-- Nome --}}
          <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end">
              Nome
            </label>
            <div class="col-md-6">
              <input id="name" type="text"
                     class="form-control @error('name') is-invalid @enderror"
                     name="name" value="{{ old('name') }}" required autofocus>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          {{-- E‑mail --}}
          <div class="mb-3 row">
            <label for="email" class="col-md-4 col-form-label text-md-end">
              E‑mail
            </label>
            <div class="col-md-6">
              <input id="email" type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     name="email" value="{{ old('email') }}" required>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          {{-- Senha --}}
          <div class="mb-3 row">
            <label for="password" class="col-md-4 col-form-label text-md-end">
              Senha
            </label>
            <div class="col-md-6">
              <input id="password" type="password"
                     class="form-control @error('password') is-invalid @enderror"
                     name="password" required>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          {{-- Confirmar Senha --}}
          <div class="mb-3 row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
              Confirmar Senha
            </label>
            <div class="col-md-6">
              <input id="password-confirm" type="password"
                     class="form-control"
                     name="password_confirmation" required>
            </div>
          </div>

          {{-- Botão Registrar --}}
          <div class="mb-0 row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                Registrar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
