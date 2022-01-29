<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies= Currency::all();


        return Inertia("Admin/Currencies/Index",[
            'currencies'=> $currencies
        ]);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CurrencyRequest $request)
    {
        if ($request->isMethod('Post')) {

            $data=$request->validated();

            Currency::create($data);
            return redirect()->route('index_currency')
            ->with('sucess','Currency created successfully');
           
        }
    


        return Inertia("Admin/Currencies/Add");
    }

    
    
    public function update(CurrencyRequest $request, Currency $currency)
    {
        if ($request->isMethod('patch')) {

            $data=$request->validated();

            $currency->update($data);
            return redirect()->route('index_currency')
            ->with('sucess','Currency updated successfully');
           
        }
    


        return Inertia("Admin/Currencies/Edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('index_currency')
        ->with('sucess','Currency deleted successfully');

    }
}
