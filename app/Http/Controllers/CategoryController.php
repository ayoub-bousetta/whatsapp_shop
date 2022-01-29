<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Mediazone;
use App\Models\Shop;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= Category::orderBy('id', 'desc')->paginate(10);


        return Inertia("Admin/Categories/Index",[
            'categories'=> $category
        ]);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRequest $request)
    {
        if ($request->isMethod('Post')) {

            $data=$request->validated();

            Category::create($data);
            return redirect()->route('index_category')
            ->with('success','Category created successfully');
           
        }
    


        return Inertia("Admin/Categories/Add");
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
                if ($request->isMethod('patch')) {


                    $data=$request->validated();

                $category->update($data);

                return redirect()->route('index_category')
                ->with('success','City updated successfully');
             }



    return Inertia("Admin/Categories/Edit",[
        'category'=>$category

    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('index_category')
        ->with('success','Country is destroyed successfully');
    }






















//Front Page


function Show_products_by_category($slug){


    $mediazonId=Mediazone::ThumbnailId();
   

    $category_id = Category::where('slug',$slug)->firstOrFail();
    
    $Shops =Shop::with(['medias'=> function ($query) use ($mediazonId) {
       $query->where('mediazone_id', $mediazonId);
   },'city'=> function($query) {
    $query->select('id','name','country_id');
},'city.country'=> function($query) {
    $query->select('id','name');
}])
   ->select('id', 'name', 'slug','online','adresse',
       'description','category_id','city_id')
       ->where('shops.online',1)
       ->where('category_id',$category_id->id)
       ->paginate(12)
       ;


   

    return inertia('Front/Marketplace/Categories',[
        'Shops'=>$Shops,
        'Catname'=>$category_id->name
    ]);


}















}
