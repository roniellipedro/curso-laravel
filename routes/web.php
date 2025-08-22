<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produto.index');

Route::get('/produto/{slug}', [ProdutoController::class, 'details'])->name('produto.details');

Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria');
