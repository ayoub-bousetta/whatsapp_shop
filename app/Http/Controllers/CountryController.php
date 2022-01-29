<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country= Country::orderBy('id', 'desc')->paginate(10);



        return Inertia("Admin/Country/Index",[
            'countries'=> $country
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CountryRequest $request)
    {
        if ($request->isMethod('Post')) {

            $data=$request->validated();

            Country::create($data);
            return redirect()->route('index_country')
            ->with('success','Country created successfully');
           
        }
    


    return Inertia("Admin/Country/Add");
    }

   



  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        if ($request->isMethod('patch')) {


            $data=$request->validated();

           $country->update($data);

           return redirect()->route('index_country')
           ->with('success','Country updated successfully');
      




   }



   return Inertia("Admin/Country/Edit",[
    'country'=>$country
]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('index_country')
        ->with('success','Country is destroyed successfully');
        
    }
}
