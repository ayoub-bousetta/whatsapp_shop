<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::all();
        return inertia('Admin/Status/Index',[
            'status'=>$status
        ]);
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(StatusRequest $request)
    {

            if ($request->isMethod('Post')) {
                
                $data=$request->validated();



                Status::create($data);
                return redirect()->route('index_status')->with('success','Status created successfully');
            }




        return inertia('Admin/Status/Add');
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, Status $status)
    {
        if ($request->isMethod('patch')) {
                
            $data=$request->validated();



            $status->update($data);
            return redirect()->route('index_status')->with('success','Status updated successfully');
        }




    return inertia('Admin/Status/Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('index_status')->with('success','Status Deleted successfully');


    }
}
