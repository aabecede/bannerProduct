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

Route::get('/base-content', function () {
    return view('landing-page.layout.content');
});

Route::get('/', 'App\Http\Controllers\LandingPage\ViewLandingPage@index');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/login', 'App\Http\Controllers\Login\ViewLogin@index');

Route::get('/register', 'App\Http\Controllers\Login\ViewLogin@register');

Route::resource('/profile', App\Http\Controllers\Profile\ProfileController::class)->only(['edit'])->middleware(['auth']);
Route::post('/profile/{user}/edit', 'App\Http\Controllers\Profile\ProfileController@update')->middleware(['auth']);

Route::post('/login', 'App\Http\Controllers\Login\DeliverLogin@login');
Route::post('/register', 'App\Http\Controllers\Login\DeliverLogin@register');

Route::get('/gender/list', 'App\Http\Controllers\Gender\DeliverGender@getAllGender');
Route::get('/produk/{id}', 'App\Http\Controllers\Admin\Dashboard\Produk\ViewProduk@landingPageDetail');

Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/dashboard', 'App\Http\Controllers\Admin\Dashboard\ListUser\ViewListUser@index');
        /** PRODUK */
        Route::get('/produk', 'App\Http\Controllers\Admin\Dashboard\Produk\ViewProduk@index');
        Route::get('/produk/create', 'App\Http\Controllers\Admin\Dashboard\Produk\ViewProduk@create');
        Route::post('/produk', 'App\Http\Controllers\Admin\Dashboard\Produk\DeliverProduk@create');
        Route::get('/produk/{id}', 'App\Http\Controllers\Admin\Dashboard\Produk\ViewProduk@detail');
        Route::get('/produk/{id}/edit', 'App\Http\Controllers\Admin\Dashboard\Produk\ViewProduk@edit');
        Route::post('/produk/edit/{id}', 'App\Http\Controllers\Admin\Dashboard\Produk\DeliverProduk@edit');
        Route::delete('/produk/{id}', 'App\Http\Controllers\Admin\Dashboard\Produk\DeliverProduk@delete');

        Route::resource('banner-produk', App\Http\Controllers\Admin\BannerProduk\BannerProdukController::class);
        Route::post('banner-produk/edit/{banner}', 'App\Http\Controllers\Admin\BannerProduk\BannerProdukController@update');
        Route::resource('list-user', App\Http\Controllers\Admin\User\UserController::class);
        Route::post('list-user/edit/{user}', 'App\Http\Controllers\Admin\User\UserController@update');
        Route::post('list-user/verified/{user}', 'App\Http\Controllers\Admin\User\UserController@verifikasi');
    });

