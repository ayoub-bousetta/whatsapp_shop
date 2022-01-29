<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post') ) {
            return [
                'name' => ['required', Rule::unique('shops'),'max:255'],
                'slug' => ['required',  Rule::unique('shops'),'max:255'],

                'description'=>'required|string',
                'seo_description'=>'nullable|string',
                'online'=>'required|boolean',
                'adresse'=> 'required|string',
                'lat'=> ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'lng'=> ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'phone' => 'required|unique:shops|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'whatsapp_number'=>'required|regex:/^\+[1-9]{1}[0-9]{3,14}$/|min:10',
                'category_id'=>'required|exists:categories,id',

                'currency_id'=>'required|exists:currencies,id',
                'city_id'=>'required|integer|exists:cities,id',
                'user_id'=>'required|exists:users,id',
                'facebook' =>[ 'nullable','url','regex:/(https?:\/\/)?([\w\.]*)facebook\.com\/([a-zA-Z0-9_]*)$/','min:10'],
                'instagram' =>[ 'nullable','url','regex:/(https?:\/\/)?([\w\.]*)instagram\.com\/([a-zA-Z0-9_]*)([^\/]+)\/?$/','min:10'],
                
           
           
           
           
           
            ];
        }elseif ($this->isMethod('patch')) {
            return [
              

                'name' => ['required',  Rule::unique('shops')->ignore($this->id),'max:255'],
                'slug' => ['required',  Rule::unique('shops')->ignore($this->id),'max:255'],

           
                'description'=>'nullable|string',
                'adresse'=> 'required|string',
                'lat'=> ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'lng'=> ['nullable','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'whatsapp_number'=>'required|regex:/^\+[1-9]{1}[0-9]{3,14}$/|min:10',
                'category_id'=>'required|exists:categories,id',

                'currency_id'=>'required|exists:currencies,id',
                'city_id'=>'required|integer|exists:cities,id',
                'user_id'=>'required|exists:users,id',
                'facebook' =>[ 'nullable','url','regex:/(https?:\/\/)?([\w\.]*)facebook\.com\/([a-zA-Z0-9_]*)$/','min:10'],
                'instagram' =>[ 'nullable','url','regex:/(https?:\/\/)?([\w\.]*)instagram\.com\/([a-zA-Z0-9_]*)([^\/]+)\/?$/','min:10'],
           
                'seo_description'=>'nullable|string',
                'online'=>'required|boolean',
           
           
           
           
           
           
           
           
           
           
           
            ];
        }else{
            return [];
        }
    }



    protected function getValidatorInstance()
    {   

      

        if ($this->isMethod('post') || $this->isMethod('patch')) {
             $data = $this->all();
           

             if($data['city_id']){
                $LatLng=  $this->getLatLng($data['adresse'],$data['city_id']);
                $data['lat'] = $LatLng['lat']  ;
                $data['lng'] = $LatLng['long'];
             }

          





            $data['slug'] = Str::slug($data['name']);
          

            $data['user_id'] = auth()->id();
           
            
            $this->getInputSource()->replace($data);

            return parent::getValidatorInstance();

          }else{
            return parent::getValidatorInstance();
          }
    }





    private function getLatLng($addr,$city_id){

        $city_name=  City::where('id',$city_id)->first()->slug;

                
                    $address = $addr;
                    $address = str_replace(" ", "+", $address);
                    $address = $address .'+'. $city_name;
                    $region = "MA";
                    $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$address,+$region&key=".config('app.googlekey'));
                    $json = json_decode($json);

                        



                    if ($json->{'status'}  != "ZERO_RESULTS") {


                        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                    }else{
        
        
                        $address = $city_name;
                        $region = "MA";
                        $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$address,+$region&key=".config('app.googlekey'));
                        $json = json_decode($json);
        
        
        
        
        
        
                        if ($json->{'status'}  != "ZERO_RESULTS") {
        
                            $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                            $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        
                        }else{

                            $lat =null;
                            $long =null;

                        }
        
        
        
        
        
        
        
                    }
                 


                    return ['lat'=>$lat ,'long'=>$long];
    }

}




