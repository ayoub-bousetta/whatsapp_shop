<?php

namespace App\Http\Controllers;

use App\Events\Orders;
use App\Http\Requests\ShopRequest;
use App\Models\Adresse;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Mediazone;
use App\Models\Method;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Models\Shop;
use App\Models\Status;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Notifications\Orders as NotificationsOrders;
use Illuminate\Support\Str;
use Inertia\Inertia;
use SebastianBergmann\Environment\Console;

class ShopController extends Controller
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
    public function index()
    {   



        $Shops = Shop::with('medias.mediazonetype')
        ->where('user_id',Auth::user()->id)
        ->select('id', 'name', 'slug','online','description')
        ->withCount('products')->paginate(10);
        // ->whereHas('medias.mediazonetype', function ($q) {
        //     $q->where('mediazones.slug','thumbnail');
        //   })


       
        
        return inertia('Auth_Users/Shops/Index',[

            'shops' => $Shops,
          
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ShopRequest $request)
    {   

     
        if ($request->isMethod('post')) {



         





            $data=$request->validated();


           $Shop= Shop::create($data);


           


           $this->ImageServices->saveImage($Shop);
          
        


         

        



            return redirect()->route('index_shop')->with('success','Your Shop was successfully saved');
            
           
        }

        $currencies=Currency::all();

        $countries=Country::all();
        $categories=Category::all();
      
        

      

        return inertia('Auth_Users/Shops/Add',[
            'currencies'=>$currencies,
            'countries'=>$countries,
            'categories'=>$categories
      
            
          

        ]);
    }

  
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $Shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $Shop)
    {

        $this->authorize('update', $Shop);
        
        if ($request->isMethod('patch')) {

            $data=$request->validated();

          $Shop->update($data);




           
          $this->ImageServices->saveImage($Shop);

            return redirect()->route('index_shop')
            ->with('success','Your Shop was successfully saved');
            
           
        }


        $currencies=Currency::all();
        $countries=Country::all();
        $categories=Category::all();





        return inertia('Auth_Users/Shops/Edit',[

            'currencies'=>$currencies,
            'countries'=>$countries->load(['cities']),
            'categories'=>$categories,
            
            
          
            'Shop'=>$Shop->load(['medias.mediazonetype','city.country'])
        ]);
    }



    //show oNe with products
    public function showone($id,$slug)
    {
        $getShop = Shop::findOrFail($id);
        $this->authorize('showone',$getShop);

        
        
        $Shop = Shop::with(['products' => function ($query) {
            $query->select('id','shop_id', 'name', 'slug','online','section_id');
        },'products.section'=> function ($query) {
            $query->select('id', 'name','shop_id','slug');
        },'medias.mediazonetype','currency',
        'city.country'])
        ->withSum('orders as totalRev', 'data->total')
        ->withCount('orders as countorders')
        ->withCount('products as totalProduct')
        ->where('id',$id)->where('slug',$slug)->firstOrFail();


        

        return inertia('Auth_Users/Shops/View',[

            'Shop'=>$Shop->only('id', 'name', 'slug','medias','currency','products','totalProduct','totalRev','countorders'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $Shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $Shop)
    {
        $this->authorize('delete', $Shop);
        $this->ImageServices->deleteFromDB($Shop->id,$Shop);
        $Shop->sections()->delete();
        $Shop->orders()->delete();
        $Shop->products()->delete();
        $Shop->delete();

       
        return redirect()->route('index_shop')
        ->with('success','Your Shop was successfully saved');
    }











    //Front Pages

    public function index_shop($id,$slug,$section_id=null,$_search=null)
    {

        $mediazonId=Mediazone::ThumbnailId();
  

      
     
        $Shops = Shop::with(['currency'=> function($query) {
            $query->select('id','symbole','name');
        },'city'=> function($query) {
            $query->select('id','name','country_id');
        },'city.country'=> function($query) {
            $query->select('id','name');
        },'medias.mediazonetype'])->FindOrFail($id);





        $sections=Section::where('shop_id',$id)
        ->when($section_id, function ($query, $section_id) {
            return $query->where('id', $section_id);
        })
        ->has('products')
        ->paginate(1);







  

        // $product=Product::whereIn('section_id',$paginationSection)
        // ->with(['medias'=> function ($query) use ($mediazonId) {
        //     $query->where('mediazone_id', $mediazonId);
        // }])
        // ->paginate(1);

      

        // $product = Product::with(['section',
        // 'medias'=> function ($query) use ($mediazonId) {
        //     $query->where('mediazone_id', $mediazonId);
        // },'medias.mediazonetype'])
        // ->where('shop_id',$id)
        // ->paginate(2);
        


        if(request()->wantsJson()){


            return $sections;
        }
        


          //  dd($product->groupBy('section.name', true));
        
        


        return inertia('Front/Shop/index',[

            'Shop'=>$Shops->ToArray(),
            'Sections'=>$sections
            
        ]);



        
    }



    function get_products($section_id,$id){






        $mediazonId=Mediazone::ThumbnailId();
        $product = Product::with(['section',
        'medias'=> function ($query) use ($mediazonId) {
            $query->where('mediazone_id', $mediazonId);
        },'medias.mediazonetype'])
        ->where('shop_id',$id)
        ->where('section_id',$section_id)
        ->paginate(2);





        if(request()->wantsJson()){


            return $product;
        }


    }



    //Update Card

    function get_my_cart(){


        return inertia('Front/Shop/myCarte');





    }





    //send data 

    function send_data_via_watsp(){



        if(request()->id !="" && request()->cnt != ""){





            $method = Method::where('slug','cash-on-delivery')->first()->id;
            $status = Status::where('slug','pending')->first()->id;
                $User_adress = Adresse::where('user_id',Auth::user()->id)->first()->id;
    
            $findshop =  Shop::with('user')->where('id',request()->id)->get();



            if( !$findshop->isEmpty()){



                $data= "Hello ".ucfirst($findshop->first()->name)." i would to order the following items :". "\r\n"."\r\n"  ;
                $datatosave=[];
                $finalPrice=0;

                $count=count(request()->cnt );
                $i=1;
                foreach (request()->cnt as $key => $value) {

                    



                    $variantstosave=[];
$variants="";




                    if(count($value['Variants']) > 0){

                        


                        foreach ($value['Variants'] as $keys => $vars) {


                            $variants.=$vars['name']." ";
                            $variantstosave[]=["name"=>$vars['name'],'price'=>$vars['price']];
                            
                            


                        }



                    }
                    


                    $finalPrice=$value['finalprice'];


                    if(count($variantstosave) >0){
                        $datatosave =[
                        
                       
                            'variants' =>$variantstosave
    
    
    
                        ];

                    }

                    


                
                    $data.='Product :'.$value['name']. "\r\n"  ;
                    $data.='Price : '.$value['finalprice']." ".$value['shop_currency']." ". "\r\n"  ;
                  
                    if($variants!=''){

                        $data.='variants : '.' '.$variants. "\r\n" ;
                    }
                   
                   
                


                    if($count > $i){
                        $data.='----------------------------------------------------------' . "\r\n";
                    }




                    $datasave[]=[
                        'name'=>$value['name'],
                        'subtotal'=>$finalPrice,
                        'total'=>$finalPrice,
                        'variants'=>json_encode($datatosave),
                        'unit_price'=>$value['price'],
                        'qty'=>$value['qty'],
                        'id_items'=>$value['id_item']
    
    
                    ];
    
                    

    
                  
     $i++;
                }


                $datasaveOrder=[
                   
                    'user_id'=>Auth::user()->id,
                    'method_id'=>$method ,
                    'status_id'=>$status ,
                    'shop_id'=> $findshop->first()->id,
               
                    'data'=>json_encode($datasave),
                    'adresse_id'=>$User_adress, 
                  
                    'currency'=>$value['shop_currency'],


                ];




  $order = Order::create($datasaveOrder);
  $shopOwner = $findshop->first();



  $orderData= [
    'shop_id'=>$shopOwner->id,
    'order_id'=> $order->id,
    'name'=>$shopOwner->name,
    'slug'=>$shopOwner->slug,
    'user_id'=>$shopOwner->user_id,
    
      ];

  $shopOwner->user->notify(new NotificationsOrders($orderData));




            // $table->foreignId('adresse_id');  
            // $table->foreignId('method_id');  
            // $table->foreignId('user_id')->constrained('users');  
            // $table->foreignId('status_id');  
            // $table->float('subtotal');
            // $table->float('total');

   


               
            $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
          $ulrtoshow=  strtr(rawurlencode($data), $revert);









      
                $url = "https://wa.me/212" . $findshop->first()->whatsapp_number . "?text=" . $ulrtoshow;

                        

                   // event(new Orders());



                    return  $url;
                
                
                


            }

                


        }


    }












function my_orders(){

   $orders= Order::where('user_id',Auth::user()->id)->paginate();


    
    return inertia('Front/Shop/myOrders',[

        'orders'=>$orders->load('shop','status'),

    ]);


}
   





function marketplace(){


    $mediazonId=Mediazone::ThumbnailId();
   
    
    $Shops =Category::whereHas('shops', function ($q) {
             $q->where('shops.online',1);
          })->with(['shops.city.country',
        'shops'=> function ($query) {
            $query->select('id', 'name', 'slug','city_id','online','adresse',
            'description','category_id')->where('shops.online',1)->limit(12);
        },'shops.medias'=> function ($query) use ($mediazonId) {
            $query->where('mediazone_id', $mediazonId);
        }])->paginate(1);


    
    // Shop::with('medias.mediazonetype','category')
    // ->select('id', 'name', 'slug','online','description')
    // ->orderby('created_at')
    // ->withCount('products')->paginate(10);


    $slidersshops = Shop::with(['city.country','medias'=> function ($query) use ($mediazonId) {
        $query->where('mediazone_id', $mediazonId);
    }])
    ->select('id', 'name', 'slug','online','phone','instagram','city_id','facebook','adresse','description')
    ->orderby('created_at')
    ->withCount('products')
    ->limit(5)->get();






    if(request()->wantsJson()){


        return $Shops;
    }












    return inertia('Front/Marketplace',[
        'Shops'=>$Shops,
        'Slidersshops'=>$slidersshops
    ]);



}




}
