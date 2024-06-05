<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [AdminController::class, 'products']);

Route::get('/orders', [AdminController::class, 'vieworders']);

Route::post('/uploadProducts', [AdminController::class, 'uploadProducts']);

Route::get('/product_detail/{id}', [HomeController::class, 'product_detail'])->name('product_detail');
Route::post('/product_detail/{id}/rate', [HomeController::class, 'submitRating'])->name('submit_rating');

Route::get('/products_table', [AdminController::class, 'index'])->name('products.index');
Route::get('/products_table/{product}/edit', [AdminController::class, 'edit'])->name('products.edit');
Route::put('/products_table/{product}', [AdminController::class, 'update'])->name('products.update');
Route::delete('/products_table/{product}', [AdminController::class, 'destroy'])->name('products.destroy');

// routes/web.php
Route::post('/add_to_cart/{id}', [HomeController::class, 'add_to_cart'])->name('add_to_cart');

Route::get('/Electronics&Mobiles', [HomeController::class, 'ElectronicsMobiles']);
Route::get('/Health&Beauty', [HomeController::class, 'HealthBeauty'])->name('HealthBeauty');
Route::get('/CarAccessories', [HomeController::class, 'CarAccessories'])->name('CarAccessories');
Route::get('/Sports&Fitness', [HomeController::class, 'SportsFitness'])->name('SportsFitness');

Route::post('/rate_product/{id}', 'ProductController@rateProduct')->name('rate_product');

Route::get('/categories', [HomeController::class, 'showCategories'])->name('categories');


Route::get('/updatestatus/{id}', [AdminController::class, 'updatestatus']);

Route::get('/search-products', [HomeController::class, 'searchProducts'])->name('searchProducts');

Route::post('/addcart/{id}', [HomeController::class, 'addcart']);

Route::get('/showcart', [HomeController::class, 'showcart'])->name('showcart');;

Route::get('/delete/{id}', [HomeController::class, 'deletecart']);

Route::post('/orders', [HomeController::class, 'orders']);

Route::get('/redirect', [AdminController::class, 'redirect']);
