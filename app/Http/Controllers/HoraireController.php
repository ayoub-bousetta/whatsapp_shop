<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoraireRequest;
use App\Models\Horaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HoraireController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $horaires= Horaire::all();


        return Inertia("Auth_Users/Horaires/Index",[
            'horaires'=> $horaires
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(HoraireRequest $request)
    {

            if ($request->isMethod('Post')) {

              

             $data=$request->validated();
            

            

                Horaire::create($data);
                return redirect()->route('index_horaire')
                ->with('sucess','Horaire created successfully');
               
            }
        


        return Inertia("Auth_Users/Horaires/Add");
    }

  
    public function update(HoraireRequest $request, Horaire $horaire)
    {

        if ($request->isMethod('patch')) {


                 $data=$request->validated();

                $horaire->update($data);

                return redirect()->route('index_horaire')
                ->with('sucess','Horaire updated successfully');
           




        }



        return Inertia("Auth_Users/Horaires/Edit");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horaire  $horaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horaire $horaire)
    {

        $horaire->delete();
        return redirect()->route('index_horaire')->with('sucess','Horaire is destroyed successfully');
        

    }
}
