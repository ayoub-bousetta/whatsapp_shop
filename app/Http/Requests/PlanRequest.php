<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'name'=> 'required|unique:plans|max:255',
            'slug'=>'required|unique:plans|max:255',
            'description'=>'required|string',
            'features'=>'required|string',
            'price'=> "required|numeric",
            'orders_limit'=>"required|integer",
            
        ];

    }else{
        return [];
    }
    }
}


