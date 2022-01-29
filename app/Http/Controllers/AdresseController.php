<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdresseRequest;
use App\Models\Adresse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $adresse=Adresse::all();

        return inertia('Auth_Users/Adresses/Index',[

            'adresses'=>$adresse
        ]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(AdresseRequest $request)
    {

        if($request->isMethod('post'))
            {
                
                $data=$request->validated();


                



                Adresse::create($data);

                return redirect()->route('index_adresse')->with('success','Adresse created successfully');
                
            }

        return inertia('Auth_Users/Adresses/Add');

    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adresse  $adresse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, 
    Adresse $adresse)
    {
        
        if($request->isMethod('patch'))
        {

           
           

           $data=$request->all();

          

       $adresse->update($data);
            

        




           return redirect()->route('index_adresse')
           ->with('success','Adresse updated successfully');

            
        }

    return inertia('Auth_Users/Adresses/Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adresse  $adresse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adresse $adresse)
    {
        $adresse->delete();
        return redirect()->route('index_adresse')
        ->with('success','Adresse deleted successfully');

         
    }
}
