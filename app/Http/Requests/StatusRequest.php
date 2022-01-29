<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
                'name' => 'required|unique:statuses|max:255',
                'slug' => 'required|unique:statuses|max:255',
            ];
        }else{
            return [];
        }
       
    }



            public function messages()
            {
                return [
                    'name.required' => 'A title is required',
                    'slug.required' => 'A slug is required',
                ];
            }
}
