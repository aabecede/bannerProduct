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

Route::get('/login', 'App\Http\Controllers\Login\ViewLogin@index');
Route::get('/register', 'App\Http\Controllers\Login\ViewLogin@register');
Route::post('/login', 'App\Http\Controllers\Login\DeliverLogin@login');
Route::post('/register', 'App\Http\Controllers\Login\DeliverLogin@register');

Route::get('/gender/list', 'App\Http\Controllers\Gender\DeliverGender@getAllGender');


Route::prefix('backoffice')
    ->middleware(['auth'])->group(function () {
        Route::get('/', 'App\Http\Controllers\BackOffice\Dashboard\ListUser\ViewListUser@index');
    });
