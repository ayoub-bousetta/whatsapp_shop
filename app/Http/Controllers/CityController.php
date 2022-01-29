<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $cities= City::with('country')->orderBy('id', 'desc')->paginate(10);


        return Inertia("Admin/Cities/Index",[
            'cities'=> $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CityRequest $request)
    {

            if ($request->isMethod('Post')) {

                $data=$request->validated();

                City::create($data);
                return redirect()->route('index_city')
                ->with('success','City created successfully');
               
            }
        

            $countries= Country::all();
        return Inertia("Admin/Cities/Add",[

            "countries"=>$countries
        ]);
    }

  
    public function update(CityRequest $request, City $city)
    {

        if ($request->isMethod('patch')) {


                 $data=$request->validated();

                $city->update($data);

                return redirect()->route('index_city')
                ->with('success','City updated successfully');
           




        }


        $countries= Country::all();

        return Inertia("Admin/Cities/Edit",[

            "city"=>$city,
            "countries"=>$countries
        ]);
        
    }


    function FindByCountry(Request $request)
    {

        $city= City::where('country_id',$request->id)->get();

      
        return response()->json(["city"=>$city]);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {

        $city->delete();
        return redirect()->route('index_city')->with('success','City is destroyed successfully');
        

    }
}
