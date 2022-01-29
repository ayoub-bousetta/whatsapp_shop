<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $roles = Role::orderBy('id', 'desc')->paginate(10);



        return Inertia("Admin/Roles/Index",[
            'roles'=>$roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RoleRequest $request)
    {
        
      
      

        if ($request->isMethod('post')) {



          


          $data=$request->validated();

         Role::create($data);

           return redirect()->route('index_role')->with('success','Role created successfully');

        }

        return Inertia("Admin/Roles/Add");
        



        
    }




  

   




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {

        
        if ($request->isMethod('patch')) {
            $data=$request->validated();
         
                 $role->update($data);
                 return redirect()->route('index_role')->with('success','Role updated successfully');

                }

        return Inertia("Admin/Roles/Edit",[
            'role'=>$role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('index_role')->with('success','Role deleted successfully');
    }
}
