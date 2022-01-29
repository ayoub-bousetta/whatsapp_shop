<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class SectionRequest extends FormRequest
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
                'name' => ['required',
                    Rule::unique("sections")->where(
                        function ($query) {
                            return $query->where(
                                [
                                    ["shop_id", "=", $this->shop_id],
                                    ["name", "=", $this->name]
                                ]
                            );
                        })
                ],'max:255',
                'slug' => 'required|max:255',
                'shop_id'=> 'required|exists:shops,id',

            ];
        }elseif($this->isMethod('patch')){


            return [
                'name' => ['required',     Rule::unique("sections")->where(
                    function ($query)  {
                        return $query->where(
                            [
                                ["shop_id", "=", $this->shop_id],
                                ["name", "=", $this->name]
                            ]
                        );
                    })->ignore($this->id),'max:255'],
                'slug' => ['required', 'max:255'],
                'shop_id'=> 'required|exists:shops,id',
            ];

            


           
        }else{
            return [];
        }
    }


    protected function getValidatorInstance()
    {   

        if ($this->isMethod('post') || $this->isMethod('patch')) {
             $data = $this->all();



             
             $data['shop_id'] = $this->idShop;
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
