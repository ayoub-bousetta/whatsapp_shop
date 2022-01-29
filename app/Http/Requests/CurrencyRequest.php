<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
                'name' => 'required|unique:currencies|max:255',
                'slug' => 'required|unique:currencies|max:255',
                'code' => 'required|unique:currencies|max:255',
                'symbole' => 'required|unique:currencies|max:255',
            ];
        }else{
            return [];
        }
       
    }
}
