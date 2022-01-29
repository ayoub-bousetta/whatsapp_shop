<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Models\Shop;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        
        
        $sections= Section::with('products')->where('shop_id',request()->get('shopid'))->withCount('products')->latest()->paginate(10);
        


        return Inertia("Auth_Users/Sections/Index",[
            'sections'=> $sections,
            'Shopinfo'=>$this->getShop()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SectionRequest  $request)
    {   
       
        
       
        if ($request->isMethod('Post')) {

             

            $data=$request->validated();


            Section::create($data);
            return back()
            ->with('success','Section created successfully');
           
        }
    

        return Inertia("Products/sections/AddSection");
    }


   
    public function update(SectionRequest $request,$shopid,$shopslug, $section)
    {


        $sectionData=Section::findOrFail($section);

        if ($request->isMethod('patch')) {


            $data=$request->validated();

            $sectionData->update($data);

            return back()
            ->with('success','Section updated successfully');
        }

       



        

       





return 
response()->json(['section' => $sectionData->only('id','name','slug')]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }


    protected function getShop(){



       return [
           'id'=>request()->get('shopid'),
           'slug'=>  request()->get('shopSlug')
       ];

       

    }



    //Front pages

    public function get_shop_sections($shopid)
    {

    
        
        $sections= Section::has('products')
        ->where('shop_id',$shopid)->latest()->get();
        

        if(request()->wantsJson()){


            return $sections;
        }
      
    }




    
}
