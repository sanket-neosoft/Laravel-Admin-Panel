<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Middleware\Session;

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

Route::middleware([Session::class])->group(function(){
    Route::get('/testing', function() {
        return "Access granted";
    });
});

Route::get('/', function () {
    return view('pages.login');
});

Route::post('/login-user', [User::class, 'login']);


Route::get('/register', function() {
    return view('pages.register');
});

Route::post('/register-user', [User::class, 'register']);

Route::get('/dashboard', [User::class, 'dashboard'])->middleware('session');

Route::get('/dashboard/add-category', function() {
    return view('pages.addcategory');
})->middleware('session');


// Category route
Route::post('/add-category', [User::class, 'add_category'])->middleware('session');

Route::get('/dashboard/category/{id}', [User::class, 'get_category'])->middleware('session');

Route::post('/dashboard/category/edit', [User::class, 'edit_category'])->middleware('session');

Route::delete('/dashboard/category/delete', [User::class, 'delete_category'])->middleware('session');

// Admin operations
Route::get('/change-password', [User::class, 'change_pass'])->middleware('session');

Route::post('/chng-pass', [User::class, 'chng_pass'])->middleware('session');

Route::get('/logout', [User::class, 'logout']);

Route::get('/change-image', function() {
    return view('pages.changeimage');
})->middleware('session');

Route::post('/chng-image', [User::class, 'change_image']);

Route::get('/change-profile', function() {
    return view('pages.changeprofile');
})->middleware('session');

Route::post('/chng-profile', [User::class, 'change_profile'])->middleware('session');

// products route 
Route::get('/dashboard/products', [User::class, 'products'])->middleware('session');

Route::get('/dashboard/products/add-product', [User::class, 'product'])->middleware('session');

Route::get('/dashboard/product/{id}', [User::class, 'get_product'])->middleware('session');

Route::delete('/dashboard/product/delete', [User::class, 'delete_product'])->middleware('session');

Route::post('/dashboard/product/edit', [User::class, 'edit_product'])->middleware('session');

Route::post('/add-product', [User::class, 'add_product'])->middleware('session');
