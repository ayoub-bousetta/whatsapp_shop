<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class RoleRequest extends FormRequest
{


    protected $stopOnFirstFailure = true;
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
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|unique:roles|max:255',
                'slug' => 'required|unique:roles|max:255',
            ];
        }else{
            return [];
        }
       
    }


    protected function getValidatorInstance()
    {   

        if ($this->isMethod('post') || $this->isMethod('patch')) {
             $data = $this->all();
            $data['slug'] = Str::slug($data['name']);
            
            $this->getInputSource()->replace($data);

            return parent::getValidatorInstance();

          }else{
            return parent::getValidatorInstance();
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
