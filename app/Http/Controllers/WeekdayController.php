<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeekdayRequest;
use App\Models\Weekday;
use Illuminate\Http\Request;

class WeekdayController extends Controller
{
   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weekday= Weekday::all();


        return Inertia("Admin/Weekdays/Index",[
            'weekdays'=> $weekday
        ]);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(WeekdayRequest $request)
    {
        if ($request->isMethod('Post')) {

            $data=$request->validated();

            Weekday::create($data);
            return redirect()->route('index_weekday')
            ->with('sucess','Weekday created successfully');
           
        }
    


        return Inertia("Admin/Weekdays/Add");
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function update(WeekdayRequest $request, Weekday $weekday)
    {
                if ($request->isMethod('patch')) {


                    $data=$request->validated();

                $weekday->update($data);

                return redirect()->route('index_weekday')
                ->with('sucess','City updated successfully');
             }



    return Inertia("Admin/Weekdays/Edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weekday  $weekday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weekday $weekday)
    {
        $weekday->delete();
        return redirect()->route('index_weekday')
        ->with('sucess','Country is destroyed successfully');
    }
}
