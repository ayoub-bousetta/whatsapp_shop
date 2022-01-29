<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\VariantController;

use Illuminate\Support\Facades\Route;










Route::middleware(['auth', 'verified'])->get('/my-orders',[ShopController::class,'my_orders'])
->name('my_orders');
Route::get('/marketplace',[ShopController::class,'marketplace'])
->name('Marketplace');

Route::get('/my-cart',[ShopController::class,'get_my_cart'])->name('my-cart');



Route::post('/my-cart',[ShopController::class,'send_data_via_watsp'])->name('send_via_watsp');



Route::get('/category/{slug}',[CategoryController::class,'Show_products_by_category'])
->name('_category');






//Ajax requests
Route::get('/section/{section_id}/shop/{id}/products',[ShopController::class,'get_products'])
->name('_shop_ajax_product');

Route::get('/shop/{shopid}/sections',[SectionController::class,'get_shop_sections'])
->name('_shop_ajax_sections');


//updateCart
Route::post('/shop/{type}',[ShopController::class,'update_number_cart'])
->name('_Update_cart');

Route::get('/shop/{shopid}/details/{product_id}',[DetailController::class,'get_products_details'])
->name('_getDetails_products');

Route::get('/shop/{shopid}/variants/{product_id}',[VariantController::class,'get_products_var'])
->name('_getVariants_products');






Route::get('/{id}-{slug?}/{product_id}-{product_slug}',[ProductController::class,'single_product_shop'])
->name('_single_product_shop');

Route::get('/{id}-{slug}/{section_id?}/{_search?}',[ShopController::class,'index_shop'])->name('_shop_index');

