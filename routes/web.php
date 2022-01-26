<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@postLogin');
Route::post('/register', 'AuthController@postRegister');
Route::post('/logout', 'AuthController@logout')->middleware('auth')->name('logout');


Route::get('/products', 'ProductController@products')->name('products')->middleware('auth');

Route::get('/all-products', 'ProductController@products')->name('products')->middleware('auth');
Route::post('/bulk-delete', 'ProductController@bulkDelete');
Route::post('/postProduct', 'ProductController@postProduct');

Route::get('/editProduct/{id}', 'ProductController@edit');
Route::post('/updateProduct', 'ProductController@update');

Route::get('/forget-password', 'AuthController@forgetPassword');
Route::post('/send-forget-password-link', 'AuthController@sentForgetPasswordLink');
Route::get('password-reset/{token}', function ($token) {
    return view('authentication.reset-password')->with(['token' => $token]);
});
Route::post('update-forget-password', 'AuthController@updateAdminForgotPassword');
