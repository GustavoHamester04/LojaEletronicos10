@extends('layouts.app')

@section('titulo', 'Detalhes da Venda')

@section('conteudo')
    <h1>Detalhes da Venda</h1>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>ID:</strong> {{ $venda->id }}</li>
        <li class="list-group-item"><strong>Cliente:</strong> {{ $venda->cliente->nome }}</li>
        <li class="list-group-item"><strong>Endereço:</strong> {{ $venda->endereco->descricao }}</li>
        <li class="list-group-item"><strong>Valor Total:</strong> R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
        </li>
    </ul>

    <h3>Produtos Comprados</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venda->produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->pivot->quantidade }}</td>
                    <td>R$ {{ number_format($produto->pivot->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Voltar</a>
@endsection