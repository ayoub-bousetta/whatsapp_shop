<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
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


        
        if ($this->isMethod('post')) {
            return [
                'name' => ['required', Rule::unique('products'),'max:255'],
            'slug' => ['required', Rule::unique('products'),'max:255'],
            
                'description'=>'required|string',
                'summary'=>'nullable|string',


                'type_id'=>'required|exists:types,id',
                'unit_price'=> "required|numeric|gt:0",
                'section_id'=>'required|exists:sections,id',
                'seo_description'=>'nullable|string',
                'online'=>'required|boolean',
                'sku'=>'sometimes|unique:products|max:255',
                'shop_id'=>'required|exists:shops,id',


                'variants.*.name'=>'sometimes|regex:/^[a-zA-Z0-9\s]+$/',
                'variants.*.options.*.name'=>'sometimes|string|regex:/^[a-zA-Z0-9\s]+$/',
                'variants.*.options.*.additional_amount' => 'required_with:variants.*.options.*.name|numeric|gt:0',


                'details.*.attribute'=>'sometimes|regex:/^[a-zA-Z0-9\s]+$/',
                'details.*.value'=>'required_with:details.*.attribute|string',
                
    
            ];
        }elseif ($this->isMethod('patch')) {
            return[
            'name' => ['required',  Rule::unique('products')->ignore($this->id),'max:255'],
            'slug' => ['required',  Rule::unique('products')->ignore($this->id),'max:255'],
            
            'description'=>'nullable|string',
            'summary'=>'nullable|string',
            'type_id'=>'required|exists:types,id',
            'unit_price'=> "required|numeric|gt:0",
            'section_id'=>'required|exists:sections,id',
            'seo_description'=>'nullable|string',
            'online'=>'required|boolean',
           
            'sku' => ['sometimes',  Rule::unique('products')->ignore($this->id),'max:255'],

            'shop_id'=>'required|exists:shops,id',

            'variants.*.name'=>'sometimes|string',
            'variants.*.options.*.name'=>'sometimes|string',
            'variants.*.options.*.name'=>'sometimes|string',
            'variants.*.options.*.additional_amount' => 'required_with:variants.*.options.*.name|numeric|gt:0',
            'details.*.attribute'=>'sometimes|regex:/^[a-zA-Z0-9\s]+$/',
            'details.*.value'=>'required_with:details.*.attribute|string',
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
            
         
          }
            return parent::getValidatorInstance();

          

         
          
    }




















}
