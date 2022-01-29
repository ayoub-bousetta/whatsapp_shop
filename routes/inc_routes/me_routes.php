<?php

use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes Guesst or customer
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







Route::middleware(['auth', 'verified','CheckRole'])->prefix('me')->group(function () {

 
      //Profiles
      Route::get('/profile', [ProfileController::class,'index'])->name('_me_index_profile');
      Route::match(['get', 'patch'],'/profile/edit', 
      [ProfileController::class,'update'])->name('_me_edit_profile');
     Route::match(['get', 'patch'],'/profile/editpassword', 
      [ProfileController::class,'updatepassword'])->name('_me_edit_password');

    
      


});




