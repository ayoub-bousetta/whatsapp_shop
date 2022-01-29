<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdressetypeRequest;
use App\Models\Adressetype;
use Illuminate\Http\Request;

class AdressetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $adressetype=Adressetype::all();

        return inertia('Admin/Adressetypes/Index',[
            'adressetypes'=>$adressetype
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(AdressetypeRequest $request)
    {
        

        if ($request->isMethod('Post')) {
            
            $data= $request->validated();

            Adressetype::create($data);
            return redirect()->route('index_adressetype')->with('success','Adresse Type created Successfully');


        }

        return inertia('Admin/Adressetypes/Add');
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adressetype  $adressetype
     * @return \Illuminate\Http\Response
     */
    public function update(AdressetypeRequest $request,
     Adressetype $adressetype)
    {
        if ($request->isMethod('patch')) {
            
            $data= $request->validated();


            $adressetype->update($data);
            return redirect()->route('index_adressetype')->with('success','Adresse Type updated Successfully');


        }

        return inertia('Admin/Adressetypes/Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adressetype  $adressetype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adressetype $adressetype)
    {
        $adressetype->delete();
        return redirect()->route('index_adressetype')->with('success','Adresse Type deleted Successfully');


    }
}
