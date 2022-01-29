<?php

use App\Http\Controllers\AdressetypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WeekdayController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes Admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth', 'verified'])->prefix('cockpit')->group(function () {

   //Roles
    Route::get('/roles', [RoleController::class,'index'])->name('index_role');
    Route::match(['get', 'post'],'/roles/add', [RoleController::class,'create'])->name('create_role');
    Route::match(['get', 'patch'],'/roles/edit/{role}', [RoleController::class,'update'])->name('edit_role');
    Route::delete('/roles/delete/{role}', [RoleController::class,'destroy'])->name('delete_role');


    //Cities
    Route::get('/cities', [CityController::class,'index'])->name('index_city');
    Route::match(['get', 'post'],'/cities/add', [CityController::class,'create'])->name('create_city');
    Route::match(['get', 'patch'],'/cities/edit/{city}', [CityController::class,'update'])
    ->name('edit_city');
    Route::delete('/cities/delete/{city}', [CityController::class,'destroy'])->name('delete_city');


     //Country
     Route::get('/countries', [CountryController::class,'index'])->name('index_country');
     Route::match(['get', 'post'],'/country/add', [CountryController::class,'create'])->name('create_country');
     Route::match(['get', 'patch'],'/country/edit/{country}', [CountryController::class,'update'])
     ->name('edit_country');
     Route::delete('/country/delete/{country}', [CountryController::class,'destroy'])->name('delete_country');
    

       //Category
       Route::get('/categories', [CategoryController::class,'index'])->name('index_category');
       Route::match(['get', 'post'],'/category/add', [CategoryController::class,'create'])->name('create_category');
       Route::match(['get', 'patch'],'/category/edit/{category}', [CategoryController::class,'update'])
       ->name('edit_category');
       Route::delete('/category/delete/{category}', [CategoryController::class,'destroy'])->name('delete_category');
   



         //Adressetypes
         Route::get('/adressetypes', [AdressetypeController::class,'index'])->name('index_adressetype');
         Route::match(['get', 'post'],'/adressetype/add', [AdressetypeController::class,'create'])->name('create_adressetype');
         Route::match(['get', 'patch'],'/adressetype/edit/{adressetype}', [AdressetypeController::class,'update'])
         ->name('edit_adressetype');
         Route::delete('/adressetype/delete/{adressetype}', [AdressetypeController::class,'destroy'])->name('delete_adressetype');
     
     //Currencies
         Route::get('/currencies', [CurrencyController::class,'index'])->name('index_currency');
         Route::match(['get', 'post'],'/currency/add', [CurrencyController::class,'create'])->name('create_currency');
         Route::match(['get', 'patch'],'/currency/edit/{currency}', [CurrencyController::class,'update'])
         ->name('edit_currency');
         Route::delete('/currency/delete/{currency}', [CurrencyController::class,'destroy'])->name('delete_currency');
 
         //Plans
         Route::get('/plans', [PlanController::class,'index'])->name('index_plan');
         Route::match(['get', 'post'],'/plan/add', [PlanController::class,'create'])->name('create_plan');
         Route::match(['get', 'patch'],'/plan/edit/{plan}', [PlanController::class,'update'])
         ->name('edit_plan');
         Route::delete('/plan/delete/{plan}', [PlanController::class,'destroy'])->name('delete_plan');
 


          
         //Plans
         Route::get('/status', [StatusController::class,'index'])->name('index_status');
         Route::match(['get', 'post'],'/status/add', [StatusController::class,'create'])->name('create_status');
         Route::match(['get', 'patch'],'/status/edit/{status}', [StatusController::class,'update'])
         ->name('edit_status');
         Route::delete('/status/delete/{status}', [StatusController::class,'destroy'])->name('delete_status');
          


               //Weekdays
               Route::get('/weekdays', [WeekdayController::class,'index'])->name('index_weekday');
               Route::match(['get', 'post'],'/weekday/add', [WeekdayController::class,'create'])->name('create_weekday');
               Route::match(['get', 'patch'],'/weekday/edit/{weekday}', [WeekdayController::class,'update'])
               ->name('edit_weekday');
               Route::delete('/weekday/delete/{weekday}', [WeekdayController::class,'destroy'])->name('delete_weekday');
                









});




