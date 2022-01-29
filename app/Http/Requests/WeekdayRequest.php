<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeekdayRequest extends FormRequest
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
    public function rules()
    {


        if ($this->isMethod('post') || $this->isMethod('patch')) {
            return [
                'name' => 'required|unique:weekdays|max:255',
                'slug' => 'required|unique:weekdays|max:255',
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
