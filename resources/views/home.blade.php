@extends('layouts.app')

@section('titulo', 'Loja de Produtos')

@section('conteudo')
    <div class="container">
        <h1 class="mb-4">Produtos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($produtos->isEmpty())
            <div class="alert alert-info">
                Nenhum produto cadastrado.
            </div>
        @else
            <div class="row">
                @foreach($produtos as $produto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            {{-- Mostrar a primeira foto do produto --}}
                            @php
                                $foto = $produto->fotos->first();
                            @endphp
                            @if($foto)
                                <img src="{{ asset('storage/' . $foto->arquivo) }}" class="card-img-top" alt="Foto do Produto" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/sem-foto.png') }}" class="card-img-top" alt="Sem Foto" style="height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $produto->nome }}</h5>
                                <p class="card-text">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                                <p class="card-text">{{ Str::limit($produto->descricao, 80) }}</p>

                                <form action="{{ route('carrinho.adicionar', $produto->id) }}" method="POST" class="mt-auto">
                                    @csrf
                                    <button class="btn btn-primary w-100">
                                        Adicionar ao Carrinho
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação se tiver muitos produtos --}}
            <div class="d-flex justify-content-center">
                {{ $produtos->links() }}
            </div>
        @endif
    </div>
@endsection
