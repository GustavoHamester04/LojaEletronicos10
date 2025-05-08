@extends('layouts.app')

@section('titulo', 'Entrar')

@section('conteudo')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Entrar</div>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
          @csrf

          {{-- E‑mail --}}
          <div class="mb-3 row">
            <label for="email" class="col-md-4 col-form-label text-md-end">
              E-mail
            </label>
            <div class="col-md-6">
              <input id="email" type="email"
                     class="form-control @error('email') is-invalid @enderror"
                     name="email" value="{{ old('email') }}" required autofocus>
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

          {{-- Lembrar-me --}}
          <div class="mb-3 row">
            <div class="col-md-6 offset-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  Lembrar‑me
                </label>
              </div>
            </div>
          </div>

          {{-- Botão Entrar e Esqueceu a Senha --}}
          <div class="mb-0 row">
            <div class="col-md-8 offset-md-4 d-flex gap-2">
              <button type="submit" class="btn btn-primary">
                Entrar
              </button>

              @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  Esqueceu sua senha?
                </a>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
