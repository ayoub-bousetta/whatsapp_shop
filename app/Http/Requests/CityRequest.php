<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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


        if ($this->isMethod('post') ) {
            return [
                'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|unique:cities|max:255',
                'slug' => 'required|unique:cities|max:255',
                'country_id'=>'required|exists:countries,id',
            ];
        }elseif($this->isMethod('patch')){


            return [
                'name' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/',  Rule::unique('cities')->ignore($this->id),'max:255'],
                'slug' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/',  Rule::unique('cities')->ignore($this->id),'max:255'],

                'country_id'=>'required|exists:countries,id',
            ];

            


           
        }
        else{
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
