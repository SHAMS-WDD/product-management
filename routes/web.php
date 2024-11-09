<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Display all products with pagination
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show the form to create a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Store a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show a specific product’s details
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Show the form to edit an existing product
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update a product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Delete a product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
