<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'user_id'=>'required|exists:users,id',
    
            ];
        }else{
            return [];
        }
       
    }



    public function messages()
    {
        return [
            'name.required' => 'A name is required',
        ];
    }
}
