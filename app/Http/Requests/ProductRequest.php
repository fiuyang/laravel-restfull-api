<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        if($this->isMethod('POST')) {
            return[
                'name' => 'required|max:255',
                'qty' => 'required|numeric',
                'price' => 'required|numeric'
            ];             
        } else {
            return [
                'name' => 'nullable',
                'qty' => 'nullable|numeric',
                'price' => 'nullable|numeric'
            ];
        }
    }

    public function messages()
    {
        if($this->isMethod('POST')) {
            return [
                'name.required' => 'Name is required',
                'name.max' => 'Name must be less than 255 characters',
                'qty.required' => 'Quantity is required',
                'qty.numeric' => 'Quantity must be numeric',
                'price.required' => 'Price is required',
                'price.numeric' => 'Price must be numeric',
            ];
        } else {
            return [
                'name.required' => 'Name is required',
                'name.max' => 'Name must be less than 255 characters',
                'qty.required' => 'Quantity is required',
                'qty.numeric' => 'Quantity must be numeric', 
                'price.required' => 'Price is required',
                'price.numeric' => 'Price must be numeric',
            ];
        }
    }
}
