<?php

use App\Http\Controllers\AdresseController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HoraireController;
use App\Http\Controllers\ImagesUploaderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ShopController;

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


// Route::domain('{account}.'.env('Server_URL', 'localhost'))->group(function () {


//   //Route::middleware(['auth', 'verified'])->prefix('clients')->group(function () {
  
//     Route::get('/', function ($account) {
//       dd($account);
//       })->name('contact');

 

// });





Route::middleware(['auth', 'verified','checkshop','CheckRole'])->prefix('clients')->group(function () {

 
      //shops
      Route::get('/shops', [ShopController::class,'index'])->name('index_shop');
      Route::match(['get', 'post'],'/shops/add', [ShopController::class,'create'])->name('create_shop');
      Route::match(['get', 'patch'],'/shops/edit/{shop}', [ShopController::class,'update'])->name('edit_shop');
      Route::delete('/shops/delete/{shop}', [ShopController::class,'destroy'])->name('delete_shop');

      
      
      //sections


      Route::get('/shop/{idShop}-{slugShop}/sections', [SectionController::class,'index'])->name('index_section');
      Route::match(['get', 'post'],'/shop/{idShop}-{slugShop}/section/add', [SectionController::class,'create'])->name('create_section');
   
   
      Route::match(['get', 'patch'],'/shop/{idShop}-{slugShop}/section/edit/{sectionid}', [SectionController::class,'update'])
      ->name('edit_section');
      Route::delete('/shop/{idShop}-{slugShop}/section/delete/{section}', [SectionController::class,'destroy'])->name('delete_section');
  

  
        //Cities
        Route::get('/cities/{id}', [CityController::class,'FindByCountry'])->name('get_city_by_country');




    //images

      Route::post('/addimagetopageavatar/{edit?}', [ImagesUploaderController::class,'AddImageAvatar'])->name('AddImage');
      Route::delete('/deleteimage', [ImagesUploaderController::class,'deleteImage'])->name('DaeleteImageCovers');
      Route::post('/clearSession', [ImagesUploaderController::class,'ClearSession'])->name('ClearImageSession');

      Route::delete('/deleteimage_id/{shopid}-{model?}-{id}', [ImagesUploaderController::class,'deleteImageById'])->name('delete_img_by_id');







      //Profiles
      Route::get('/profile', [ProfileController::class,'index'])->name('index_profile');
      Route::match(['get', 'patch'],'/profile/edit', 
      [ProfileController::class,'update'])->name('edit_profile');
      Route::delete('/profile/delete/{profile}', [ProfileController::class,'destroy'])->name('delete_profile');
     Route::match(['get', 'patch'],'/profile/editpassword', 
      [ProfileController::class,'updatepassword'])->name('edit_password');

      Route::get('/mybadgs', [ProfileController::class,'all_my_badg'])->name('all_my_badg');

      //Adresse
      Route::get('/adresses', [AdresseController::class,'index'])->name('index_adresse');
      Route::match(['get', 'post'],'/adresse/add', [AdresseController::class,'create'])->name('create_adresse');
      Route::match(['get', 'patch'],'/adresse/edit/{adresse}', [AdresseController::class,'update'])->name('edit_adresse');
      Route::delete('/adresse/delete/{adresse}', [AdresseController::class,'destroy'])->name('delete_adresse');


        //singlePage shop
      Route::get('/shop/{shopid}-{slugShop}', [ShopController::class,'showone'])->name('one_shop');

       //Product
       Route::get('/shop/{id}-{slugShop}/products', [ProductController::class,'index'])->name('index_product');
       Route::match(['get', 'post'],'/shop/{idShop}-{slugShop}/product/add', [ProductController::class,'create'])->name('create_product');
       Route::match(['get', 'patch'],'shop/{idShop}-{slugShop}/product/edit/{product}', [ProductController::class,'update'])->name('edit_product');
       Route::delete('shop/{idShop}-{slugShop}/product/delete/{product}', [ProductController::class,'destroy'])->name('delete_product');
     
     
     
      //Product Detaills
       Route::post('/details/delete/{product_id}-{detailid}',[ProductController::class,'deleteDetail'])->name('delete_details');
         
       //Product Variants 

       Route::post('/variants/delete/{product_id}-{varid}',[ProductController::class,'deleteVariant'])->name('delete_variants');


        //Variants  Item
       Route::post('/options/delete/{product_id}-{section}',[ProductController::class,'deleteOption'])->name('delete_options');

      
      //Horaires
          Route::get('/horaires', [HoraireController::class,'index'])->name('index_horaire');
          Route::match(['get', 'post'],'/horaire/add', [HoraireController::class,'create'])->name('create_horaire');
          Route::match(['get', 'patch'],'/horaire/edit/{horaire}', [HoraireController::class,'update'])->name('edit_horaire');
          Route::delete('/horaire/delete/{horaire}', [HoraireController::class,'destroy'])->name('delete_horaire');
    


          Route::get('/notifications', [OrderController::class,'index'])->name('index_notifications');

      


});




