<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Detail;
use App\Models\Option;
use App\Models\Product;
use App\Models\Section;
use App\Models\Shop;
use App\Models\Status;
use App\Models\Type;
use App\Models\Variant;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{



    private $ImageServices;
    function __construct(ImageServices $ImageServices)
    {   

        $this->ImageServices=$ImageServices;


       
       
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$slug)
    {
        

        $products=Product::all();
        return inertia('Auth_Users/Product/Index',[
            'products'=>$products
        ]);
    }




  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRequest $request,$Shopid,$slug)
    {

        

        
        
       
          if ($request->isMethod('post')) {

        
           
     
               
                $data=$request->validated();



                $dataproduct=$request->except(['variants']);
                $dataVar=$request->only(['variants']);
                $details=$request->only(['details']);


            
                $product=Product::create($dataproduct);


            
            if ( isset($details['details']) && $details['details'] >0) {


                $product->details()->createMany($details['details']);
            }
               





                $this->ImageServices->saveImage($product);

                if (isset($dataVar['variants']) && $dataVar['variants'] >0) {
             
              

                    foreach ($dataVar['variants'] as $key=>$variant) {
                    $createdVar=$product->variants()->create($variant);
                  

                        if (isset($variant['options']) && $variant['options'] >0) {
                            foreach($variant['options'] as $op =>$option){

                                $createdVar->options()->create($option);
                            }
                        }
                    
                   


                      }
                    }


//                $product->variants()->createMany($data['variants']);


             


                
                return redirect()
                ->route('one_shop',$this->getShop(true))
                ->with('success','Product created successfully');
            }


            $types=Type::all();
            $sections=Section::where('shop_id',$Shopid)->get(['id','name','shop_id']);
           

        return inertia('Auth_Users/Product/Add',[
            'types'=>$types,
            'Shop'=>$this->getShop(),
            'sections'=>$sections

        ]);
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $Shopid,$slug,Product $product)
    {
       
      
        
     
        if ($request->isMethod('patch')) {

          
               
            $data=$request->validated();
 
            $dataproduct=$request->except(['variants']);
            $dataVar=$request->only(['variants']);
            $details=$request->only(['details']);


        
            $product->update($dataproduct);
            $this->ImageServices->saveImage($product);

           // $product->variants()->createMany($data['variants']);


           if ( isset($details['details']) && $details['details'] >0) {

            foreach ($details['details'] as $key=>$detail) {

                $product->details()->updateOrCreate((['id'=>isset($detail['id']) ? $detail['id'] : "" ])
                ,$detail);
              
 
               


                  }
         

           
        }




            
            if (isset($dataVar['variants']) && $dataVar['variants'] >0) {
             
              

                foreach ($dataVar['variants'] as $id=>$variant) {

                $createdVar=$product->variants()->updateOrCreate(['id'=>isset($variant['id']) ? $variant['id'] : "" ],$variant);
              

                    if (isset($variant['options']) && $variant['options'] >0) {
                        foreach($variant['options'] as $op =>$option){
                          $createdVar->options()->updateOrCreate(['id'=>isset($option['id'])  ? $option['id'] : ""],$option);

                        }
                    }
                
               


                  }
                }




            return redirect()
            ->route('one_shop',$this->getShop(true))
            ->with('success','Product updated successfully');
        }

        $types=Type::all();

        $sections=Section::where('shop_id',$Shopid)->get(['id','name','shop_id']);
          
        return inertia('Auth_Users/Product/Edit',[
            'types'=>$types,
            'shop'=>$this->getShop(),
            'products'=>$product->load('details','variants.options','medias.mediazonetype'),
           
            'sections'=>$sections
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($Shopid,$slug,Product $product)
    {

     


        $this->ImageServices->deleteFromDB($product->id,$product);
        $Shop= ['Shopid' => $Shopid,
        'slugShop'=>$slug];
      
        $product->variants()->delete();
        $product->details()->delete();
         $product->delete();
        return redirect()
        ->route('one_shop',$this->getShop(true))
        ->with('success','Product deleted successfully');


    }



    /**
     * 
     * Delete Detail from products
     * 
     */

    
    public function deleteDetail($product_id,$detailid)
    {

    




       

        $detail=Detail::where('id',$detailid)->where('product_id',$product_id)->first();
    
       
    
        if($detail && $detail->delete()){
        return response()->json(['success'=>'Detail was successfully deleted']);
       }else{
        return response()->json(['errors'=>'Something went wrong']);

       }
        
    }




     /**
     * 
     * Delete Detail from products
     * 
     */

    
    public function deleteVariant($product_id,$varid)
    {



        $getShop=$this->getShop('',$product_id);
        $this->authorize('delete', $getShop);
        

        $Variant=Variant::where('id',$varid)->where('product_id',$product_id)->first();
    
    
    
        if($Variant && $Variant->delete()){
        return response()->json(['success'=>'Variant was successfully deleted']);
       }else{
        return response()->json(['errors'=>'Something went wrong']);

       }
        
    }

    





    
     /**
     * 
     * Delete Detail from products
     * 
     */

    
    public function deleteOption($product_id,$varid)
    {


       $getShop=$this->getShop('',$product_id);
        $this->authorize('delete', $getShop);

        $option=Option::where('id',$varid)->where('variant_id',$product_id)->first();
    
    
    
        if($option && $option->delete()){
        return response()->json(['success'=>'Option was successfully deleted']);
       }else{
        return response()->json(['errors'=>'Something went wrong']);

       }
        
    }




  
    protected function getShop($route =null){


     

        if($route){

            return [
                'shopid'=>request()->get('shopid'),
                'slugShop'=>  request()->get('shopSlug')
            ];
     


        }else{

            return [
                'id'=>request()->get('shopid'),
                'slug'=>  request()->get('shopSlug')
            ];
     

        }

       
        
 
     }








     //Front


     function single_product_shop($id,$slug,$product_id,$product_slug){


        $Shops = Shop::with(['currency'=> function($query) {
            $query->select('id','symbole','name');
        },'city'=> function($query) {
            $query->select('id','name','country_id');
        },'city.country'=> function($query) {
            $query->select('id','name');
        },'medias.mediazonetype'])->FindOrFail($id);

        $product=Product::where('shop_id',$id)->where('id',$product_id)->FirstOrFail();


      
        

        return inertia('Front/Shop/Single',[
           
            'Shop'=>$Shops,
            'products'=>$product->load('section','medias.mediazonetype'),
           
        ]);


     }
 


}
