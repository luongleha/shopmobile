<?php

namespace App\Http\Requests\Online;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'user_name' => 'required|min:10|max:255',
            'user_email' => 'required|min:10|max:255',
            'content' => 'required|min:10|max:255',
//            'images.*' => 'image|max:2000',
//            'images' => 'required'
        ];
    }


    public function messages()
    {
       return[
        'required' => 'bạn cần nhập vào :attribute',
//        'image' => ':attribute Không dung dinh dang'
    ];
}

 public function attributes()
    {
       return [
                'user_name' => 'Tên',
                'user_email' => 'Email',
                'content' => 'Bình luận',
            ];
}
}
