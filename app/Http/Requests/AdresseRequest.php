<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdresseRequest extends FormRequest
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
        if ($this->isMethod('post') || $this->isMethod('patch')) {
            return [
               'adresse' => 'required|string|max:1055',
           
              'zip_code'=>'nullable|max:11|string',
            'adressetype_id'=>'required|exists:adressetypes,id',
                     'location_id'=>'required|exists:locations,id',
                    
             'user_id'=>'required|exists:users,id',
      
           
           
           
            ];
        }else{
            return [];
        }
    }












}
