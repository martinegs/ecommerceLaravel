<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas de la tienda
Route::get('/', [TiendaController::class, 'inicio'])->name('inicio');
Route::get('/categoria/{id}', [TiendaController::class, 'categoria'])->name('categoria');
Route::get('/producto/{id}', [TiendaController::class, 'producto'])->name('producto');
Route::get('/buscar', [TiendaController::class, 'buscar'])->name('buscar');

// Rutas del carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::put('/carrito/actualizar/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// Rutas de pedidos
Route::get('/checkout', [PedidoController::class, 'checkout'])->name('checkout');
Route::post('/pedido/procesar', [PedidoController::class, 'procesar'])->name('pedido.procesar');
Route::get('/pedido/confirmacion/{id}', [PedidoController::class, 'confirmacion'])->name('pedido.confirmacion');
