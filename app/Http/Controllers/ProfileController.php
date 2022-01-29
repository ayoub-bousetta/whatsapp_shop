<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Validation\Rule;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $profile=User::with(['profile','roles'=>function($q){
            $q->latest()->first();
        }])->where('id', Auth::id())->first();




        return inertia('Auth_Users/Profile/Index',[
            'profile'=>$profile
        ]);
    }

  
   public function all_my_badg()
    {
        
        $profile=Profile::with('roles')->where('user_id', Auth::id())->first();




        return inertia('Auth_Users/Profile/badges',[
            'profile'=>$profile
        ]);
    }
   
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        

        if ($request->isMethod('patch')) {


            $userId = Auth::id();
            $user = User::findOrFail($userId);


            $validated=  $request->validate([
       
                'email' => ['required','email',  Rule::unique('users')->ignore($user->id),'max:255'],
                'profiles.phone' => ['required',Rule::unique('profiles')->ignore($user->id, 'user_id'),'regex:/^\+[1-9]{1}[0-9]{3,14}$/','min:10'],
                'profiles.name' => ['required','max:255','string'],
                'profiles.fname' => ['required','max:255','string'],
              
            ],
        
            ['profiles.phone.regex' => 'This phone is not valid please remove any space or check if it a valid number'],
            ['profiles.name.required' => 'This field is required'],
            ['profiles.fname.required' => 'This field is required'],
    
        );

     

           
            $user->email = $request->email;
            $user->save();


          $data= [ 'name' => $request->profiles['name'],
           'phone' => $request->profiles['phone'],
           'fname' => $request->profiles['fname'],];
           
        $user->profile()->update($data);

          





            return back()->with('success','Profile updated successfully');



        }


        return back();

    }

    public function updatepassword(Request $request)
    {
        

        if ($request->isMethod('patch')) {


            $validated=  $request->validate([
               
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
        
          
    
        );

     

        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $user->password = Hash::make($request->password);
        $user->save();



           // $profile->update($data);

           return back()
            ->with('success','Password updated successfully');



        }


        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()
        ->route('index_profile')
        ->with('sucess','Profile deleted successfully');


    }
}
