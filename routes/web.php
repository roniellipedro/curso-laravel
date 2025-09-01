<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::resource('/user', UserController::class);

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/produto/{slug}', [ProdutoController::class, 'details'])->name('produto.details');

Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('site.carrinho');
Route::post('/carrinho', [CarrinhoController::class, 'adicionaCarrinho'])->name('site.addcarrinho');
Route::post('/carrinho/remover', [CarrinhoController::class, 'removeCarrinho'])->name('site.removecarrinho');
Route::post('/carrinho/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('site.atualizacarrinho');
Route::get('/carrinho/limpar', [CarrinhoController::class, 'limpaCarrinho'])->name('site.limpacarrinho');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/register', [LoginController::class, 'create'])->name('login.register');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('checkemail');

    Route::get('/admin/produtos', function () {
        return view('admin.produtos');
    })->name('admin.produtos');
});
