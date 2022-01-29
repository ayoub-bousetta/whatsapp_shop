<?php


namespace App\Services;

use App\Models\Media;
use App\Models\Mediazone;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Str;


class ImageServices 
{

    //Add image To Post


    function clearTmp(){

        session()->forget('images');


     

        if(Storage::exists('tmp/'.auth()->user()->id.'-'.Str::slug(auth()->user()->email) ))
        {

            Storage::deleteDirectory('tmp/'.auth()->user()->id.'-'.Str::slug(auth()->user()->email));
        }

    }


    function deleteFromDB($Shopid,$model=null,$id=null){




       




        if(is_object($model)){
            $Model=class_basename($model);

            $Shop=get_class($model)::find($Shopid);
                if($Model=="Shop"){
                $foldername=Str::slug($Model)."s";
                }else{
                    $foldername='shops/'.$Shop->id.'/'.Str::slug($model)."s";
                }

        }else{


           $Model="App\\Models\\".ucfirst($model);
            $Shop=$Model::find($Shopid);



            if(ucfirst($model)=="Shop"){
                $foldername=Str::slug($model)."s";
                }else{
                    $foldername='shops/'.$Shop->shop_id.'/'.Str::slug($model)."s";
                }


        }

        




$ShopMedia=$Shop->medias()->when($id != null,function($q) use ($id){

    return $q->where('id', '=', $id);
})->where('mediable_id',$Shopid);



         

if(!$ShopMedia->get()->isEmpty()){

    if($id == null){
      
        //delete all the folder

           if (Storage::disk('media')->exists($foldername.'/'.$Shopid))
                   {

                  Storage::disk('media')->deleteDirectory($foldername.'/'.$Shopid);
                   
                       
                   }


                   Media::destroy($ShopMedia->get()->pluck('id')->all());







    }else{


    


        if(Storage::disk('media')->exists($foldername.'/'.$Shopid.'/'.$ShopMedia->first()->url) )
        {
    
        
    
    
            Storage::disk('media')->delete($foldername.'/'.$Shopid.'/'.$ShopMedia->first()->url);
            $ShopMedia->delete();
    
           return true;
    
    
        }else{
    
            return false;
        }


    }

  



}else{

    return false;
}




              


        

           

        }


    function saveImage($model,$typeid=null){


        $modelName=class_basename($model);

        if($modelName=="Shop"){

            $foldername=Str::slug($modelName)."s";


        }else{
            $foldername='shops/'.$model->shop_id.'/'.Str::slug($modelName)."s";
        }

        

        $arrayimage= session()->get('images');
        $coversimages=[];
        $thumbnail="";


        if($arrayimage){

                


            //thumbnail only one
                if(isset($arrayimage['thumbnail']) && count($arrayimage['thumbnail']) >0){
                          
                        $thumbnail= $arrayimage['thumbnail'][0];
            
    
                 }

            

            //coversimages
                if(isset($arrayimage['covers']) && count($arrayimage['covers']) >0){
                    $coversimages= $arrayimage['covers'];
                }

                
        }


       



        if($thumbnail != ''){


            $imagename= basename($thumbnail) ;
            $url= 'thumbnail/'.$imagename;
            $slug=Str::slug($model->id.'-'.md5(Str::random(30).time()).'-'.$model->slug);
            $name= $model->name ? $model->name:$model->name;



            $pathSource = Storage::disk('tmp')->getDriver()->getAdapter()->applyPathPrefix($thumbnail);
            $destinationPath = Storage::disk('media')->getDriver()->getAdapter()->applyPathPrefix($foldername.'/'.$model->id.'/'.$url);
       
            if (!File::exists(dirname($destinationPath))) {
               File::makeDirectory(dirname($destinationPath), 0755, true);
           }
       
           File::move($pathSource, $destinationPath);
           



           $model->medias()->create([

            'name'=>$name,
            'slug'=>$slug,
            'url'=>$url,
            'mediable_type'=>'thumbnail',
            'user_id'=>auth()->user()->id,
            'mediazone_id'=>Mediazone::ThumbnailId()
          ]);



        }



        if(count($coversimages)>0){


            $mediatosave=[];


            foreach ($coversimages as $key => $otherimage) {




                $imagename= basename($otherimage) ;
                $url= 'covers/'.md5(Str::random(30).time()).'_'.$imagename;
                $slug=Str::slug($model->id.'-'.md5(Str::random(30).time()).'-'.$model->slug);
                $name= $model->name ? $model->name:$model->name;


           

             

                $pathSource = Storage::disk('tmp')->getDriver()->getAdapter()->applyPathPrefix($otherimage);
                $destinationPath = Storage::disk('media')->getDriver()->getAdapter()->applyPathPrefix($foldername.'/'.$model->id.'/'.$url);
           

                if (!File::exists(dirname($destinationPath))) {
                   File::makeDirectory(dirname($destinationPath), 0755, true);
               }
           
               File::move($pathSource, $destinationPath);

                $mediatosave[]=[

                    'name'=>$name,
                    'slug'=>$slug,
                    'url'=>$url,
                    'mediable_type'=>'covers',
                    'user_id'=>auth()->user()->id,
                    'mediazone_id'=>Mediazone::CoverId()
                ];


            }


            $model->medias()->createMany($mediatosave);

            

        }


     





    }



    //AddImage to TMP file


    function AddImage($edit=null){

        if(request()->file('files') != ""){
            $folder ='thumbnail';
            $storedImage=request()->file('files');  
            

        }elseif(request()->file('cover') != ""){
                $folder ='covers';
                $storedImage=request()->file('cover');  
    
         }


            if(isset($edit)){
                $foldername= auth()->user()->id.'-edit-'.Str::slug(auth()->user()->email);

            }else{
                $foldername= auth()->user()->id.'-'.Str::slug(auth()->user()->email);


            }
           
                


            
            foreach($storedImage as $key=>$value){

                   

                $filename = $value->getClientOriginalName();
                $filename = pathinfo($filename,PATHINFO_FILENAME);
                $ext = $value->getClientOriginalExtension();

                

                    $this->storedImage= Storage::putFileAs(
                        'tmp/'.$foldername.'/'.$folder, $value,Str::slug($filename).'.'.$ext 
                    );

                    session()->push('images.'.$folder, $foldername."/".$folder.'/'.Str::slug($filename).'.'.$ext);

        
        
                }




    }




    //Remove Image from TMP file
    function removeFromUploader(){

        if (request()->get('file') && request()->get('type')) {
          
            $filename = pathinfo(request()->get('file'),PATHINFO_FILENAME);
            
            $ext = pathinfo(request()->get('file'),PATHINFO_EXTENSION);
            $type=request()->get('type');

            $foldername= auth()->user()->id.'-'.Str::slug(auth()->user()->email);

            $filedir = "/".$type."/";
            $sessioninputs='images.'.$type;

        if(session()->get($sessioninputs, $foldername.$filedir.Str::slug($filename).'.'.$ext)){



                $imagevaluetoremove = session()->get($sessioninputs);
        
        
                $newimageKey=array_search($foldername.$filedir.Str::slug($filename).'.'.$ext,$imagevaluetoremove  );
        
        
        
        
                session()->forget($sessioninputs.'.'.$newimageKey);
        
        
        
        
        
                if(Storage::exists('tmp/'.$foldername. $filedir.Str::slug($filename).'.'.$ext)){
        
                    Storage::delete('tmp/'.$foldername. $filedir.Str::slug($filename).'.'.$ext);
                
                  }
               }






        }



    }
    
}
