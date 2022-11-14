<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

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

/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);

Route::get('/privacy', function(){
   return view('privacy'); 
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'reg'])->name('register');
Route::post('/reg', [App\Http\Controllers\AuthController::class, 'register'])->name('reg');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/forget', [App\Http\Controllers\AuthController::class, 'forget'])->name('forget');
Route::post('/pforget', [App\Http\Controllers\AuthController::class, 'pforget'])->name('pforget');
Route::get('/verif/{id}', [App\Http\Controllers\AuthController::class, 'verif'])->name('verif');
Route::post('/pverif/{id}', [App\Http\Controllers\AuthController::class, 'pverif'])->name('pverif');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('log');

Route::group(['middleware' => 'isAdmin'], function() {    
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/whatsapp', [App\Http\Controllers\DashboardController::class, 'wa'])->name('wa');
        Route::post('/send', [App\Http\Controllers\DashboardController::class, 'send'])->name('send');
        Route::post('/lay', [App\Http\Controllers\ServiceController::class, 'lay'])->name('layanan');    
        
        Route::post('/change-password', [App\Http\Controllers\SettingController::class, 'up'])->name('up');    
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::resource('service', App\Http\Controllers\ServiceController::class);
        Route::resource('server', App\Http\Controllers\ServerController::class);
        Route::resource('setting', App\Http\Controllers\SettingController::class);
        Route::resource('order', App\Http\Controllers\OrderController::class);
        Route::resource('categori', App\Http\Controllers\CategoriController::class);
    });
});


Route::group(['middleware' => 'isUser'], function() {    
    Route::group(['prefix'=>'user'],function(){
        Route::get('/', [App\Http\Controllers\User::class, 'index'])->name('user');
        Route::get('/setting-password', [App\Http\Controllers\User::class, 'Setting'])->name('set');
        Route::resource('setting', App\Http\Controllers\SettingController::class);
        Route::post('/psetting', [App\Http\Controllers\User::class, 'psetting'])->name('psetting');
        Route::post('/submit', [App\Http\Controllers\User::class, 'submit'])->name('submit');
        Route::get('/orders', [App\Http\Controllers\User::class, 'order'])->name('orders');
        Route::get('/remote', [App\Http\Controllers\User::class, 'remote'])->name('remote');        
        Route::get('/add-remote', [App\Http\Controllers\User::class, 'addRemote'])->name('addRemote');
        Route::post('/premote', [App\Http\Controllers\User::class, 'premote'])->name('premote');
        Route::post('/add-port/{id}', [App\Http\Controllers\User::class, 'addPort'])->name('addPort');
        Route::post('/remove-port/{id}', [App\Http\Controllers\User::class, 'removePort'])->name('removePort');
        Route::get('/tunnel', [App\Http\Controllers\User::class, 'tunnel'])->name('tunnel');
        Route::post('/ptunnel', [App\Http\Controllers\User::class, 'ptunnel'])->name('ptunnel');         
        Route::get('/add-tunnel', [App\Http\Controllers\User::class, 'addTunnel'])->name('addTunnel');

        Route::post('/services', [App\Http\Controllers\User::class, 'services'])->name('services'); 
        Route::get('/pay/{id}', [App\Http\Controllers\User::class, 'pay'])->name('payment');
        Route::get('/pay-port/{id}', [App\Http\Controllers\User::class, 'payPort'])->name('payPort');
        Route::get('/services/{$ref}', [App\Http\Controllers\User::class, 'services'])->name('lay');
        Route::get('/order-tunnel/{id}', [App\Http\Controllers\User::class, 'orderTunnel'])->name('orderTunnel');
        Route::get('/device-remote/{id}', [App\Http\Controllers\User::class, 'orderRemote'])->name('orderRemote');
        
    });
});