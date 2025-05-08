<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CarrinhoController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('cidades', CidadeController::class);
Route::resource('enderecos', EnderecoController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('vendas', VendaController::class);
Route::middleware(['auth'])->group(function () {
Route::resource('categorias', CategoriaController::class);
});

Route::resource('produtos', ProdutoController::class);
Route::resource('fotos', FotoController::class);
Route::resource('clientes', ClienteController::class);

Route::middleware('auth')->group(function () {
    Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::post('carrinho/limpar', [CarrinhoController::class, 'limpar'])->name('carrinho.limpar');
    Route::post('carrinho/finalizar', [CarrinhoController::class, 'finalizar'])->name('carrinho.finalizar');
    Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizar'])->name('carrinho.finalizar');
});
