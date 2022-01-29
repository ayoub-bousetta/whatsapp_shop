<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $plans=Plan::all();
        return inertia('Admin/Plans/Index',[
            'plans'=> $plans
        ]);
    }

    
    public function create(PlanRequest $request)
    {
        

        if ($request->isMethod('post')) {


            
            
           $data= $request->validated();

           
            Plan::create($data);

            return redirect()->route('index_plan')->with('success','Plan created successfully');
        }


        return inertia('Admin/Plans/Add');
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        if ($request->isMethod('patch')) {


            
            
            $data= $request->validated();
 
            
             $plan->update($data);
 
             return redirect()->route('index_plan')->with('success','Plan created successfully');
         }
 
 
         return inertia('Admin/Plans/Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('index_plan')->with('success','Plan created successfully');

    }
}
