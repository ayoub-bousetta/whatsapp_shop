<?php

use App\Events\Orders;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RoleController;
use App\Models\Shop;
use App\Notifications\Orders as NotificationsOrders;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/lol', function(){

    $findshop =  Shop::with('user')->where('id',1)->get();

    $shopOwner = $findshop->first();


$shopOwner->user->notify(new NotificationsOrders($shopOwner));



    //event(new Orders($shopOwner));

});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('_index_home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');





require __DIR__.'/inc_routes/clients_routes.php';
require __DIR__.'/inc_routes/admin_routes.php';
require __DIR__.'/inc_routes/me_routes.php';
require __DIR__.'/auth.php';
require __DIR__.'/inc_routes/front_routes.php';
