@extends('layouts.app')

@section('titulo', 'Meu Carrinho')

@section('conteudo')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<h1 class="mb-4">Meu Carrinho</h1>

@if(empty($carrinho))
    <div class="alert alert-info">
        Seu carrinho está vazio.
    </div>
@else
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Produto</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrinho as $id => $item)
                <tr>
                    <td>{{ $item['nome'] }}</td>
                    <td>R$ {{ number_format($item['valor'], 2, ',', '.') }}</td>
                    <td>{{ $item['quantidade'] }}</td>
                    <td>R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrinho.remover', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remover produto do carrinho?')">
                                Remover
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-end">
        Total: <strong>R$ {{ number_format($total, 2, ',', '.') }}</strong>
    </h4>

    <div class="d-flex justify-content-between mt-4">
        <form action="{{ route('carrinho.limpar') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">Limpar Carrinho</button>
        </form>

        @auth
            @php
                $cliente = Auth::user()->load('enderecos');
            @endphp

            @if($cliente->enderecos->isNotEmpty())
                <form action="{{ route('carrinho.finalizar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        Finalizar Compra
                    </button>
                </form>
            @else
                <a href="{{ route('enderecos.index') }}" class="btn btn-info">
                    Cadastre um endereço para finalizar
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                Faça login para finalizar a compra
            </a>
        @endauth
    </div>
@endif

@endsection
