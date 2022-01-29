<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Adresse;
use App\Models\Adressetype;
use App\Models\City;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $roles=Role::where('slug','!=','admin')->get();


        $cities=City::all();

        
        return Inertia::render('Auth/Register')->with(['roles'=>$roles,'cities'=>$cities]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        
        
      $validated=  $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'profiles.phone' => 'required|unique:profiles|regex:/^\+[1-9]{1}[0-9]{3,14}$/|min:10',
            'profiles.name' => ['required','max:255','string'],
            'profiles.fname' => ['required','max:255','string'],
            'adresse.adresse' => ['required','max:255','string'],
            'adresse.zip_code' => ['required','max:255','string'],
            'adresse.city_id' =>'required|exists:cities,id',
            
            'roles.id' => [
                'required','integer',
                Rule::exists('roles')->where(function ($query) {
                    $query->where('slug','!=', 'admin');
                }),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
    
        ['profiles.phone.regex' => 'This phone is not valid'],
        ['profiles.name.required' => 'This field is required'],
        ['profiles.fname.required' => 'This field is required'],

    );


       


        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $Profile = new Profile();

            $Profile->name = $request->profiles['name'];
            $Profile->phone = $request->profiles['phone'];
            $Profile->fname = $request->profiles['fname'];
           
        $user->profile()->save($Profile);

        $adressetype_id=Adressetype::where('slug','billing-address')->first()->id;

        $Adress = new Adresse();

        $Adress->adresse = $request->adresse['adresse'];
        $Adress->zip_code = $request->adresse['zip_code'];
        $Adress->city_id = $request->adresse['city_id'];
        $Adress->adressetype_id = $adressetype_id;
       
    $user->adresses()->save($Adress);



        $user->roles()->attach($request->roles['id']);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
