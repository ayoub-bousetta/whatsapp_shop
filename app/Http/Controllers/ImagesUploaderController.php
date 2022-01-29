<?php

namespace App\Http\Controllers;

use App\Services\ImageServices;
use Illuminate\Http\Request;

class ImagesUploaderController extends Controller
{


    // background: linear-gradient(to right, #ff8983 17.85%, #7f0e7f 53.28%, #007a65 100%);

            private $ImageServices;
                function __construct(ImageServices $ImageServices)
                {

                    $this->ImageServices=$ImageServices;
                    
                }


    public function deleteImage(){

       
        $this->ImageServices->removeFromUploader();
       
        return back();


    }



    
    public function AddImageAvatar(){

        
       
       
        $this->ImageServices->AddImage();
        return back();




      
             
      
    }


    public function ClearSession(){
        $this->ImageServices->clearTmp();
       
    }

        public function deleteImageById ($shopid,$model,$id){


          
               $imagedeleted = $this->ImageServices->deleteFromDB($shopid,$model,$id);


               if ($imagedeleted) {
                return back()->with('success','Your image was successfully deleted');
               }else{
                return  back()->with('error','Something went wrong with your image');
               }
            
            }


}
