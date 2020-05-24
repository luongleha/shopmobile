<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'name' => 'required|min:10|max:255',
            'origin_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
//            'images.*' => 'image|max:2000',
//            'images' => 'required'
        ];
    }


    public function messages()
    {
       return[
        'required' => ':attribute Không được để trống',
        'min' => ':attribute Không được nhỏ hơn :min',
        'max' => ':attribute Không được lớn hơn :max',
//        'image' => ':attribute Không dung dinh dang'
    ];
}

 public function attributes()
    {
       return [
                'name' => 'Tên sản phẩm',
                'content' => 'Mo ta sản phẩm',
                'origin_price' => 'Giá gốc',
                'sale_price' => 'Giá bán'
            ];
}
}
