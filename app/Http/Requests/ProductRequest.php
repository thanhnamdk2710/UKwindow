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
        switch ($this->method()){
            case "POST":
                return [
                    'name' => 'required|unique:products,name',
                    'product_code' => 'required|unique:products,product_code',
                    'image' => 'required|image',
                    'price' => 'required|integer',
                ];
            case "PUT":
                return [
                    'name' => 'required',
                    'product_code' => 'required',
                    'image' => 'image',
                    'price' => 'required|integer',
                ];
        }
    }

    public function messages()
    {
        return [
            'name.required'=> 'Vui lòng nhập tên sản phẩm.',
            'name.unique'=> 'Tên sản phẩm đã tồn tại.',
            'product_code.required'=> 'Vui lòng nhập mã sản phẩm.',
            'product_code.unique'=> 'Mã sản phẩm đã tồn tại.',
            'image.required'=> 'Vui lòng chọn hình ảnh.',
            'image.image'=> 'Vui lòng chọn đúng định dạng hình ảnh JPG, PNG, JPEG, GIF.',
            'price.required'=> 'Vui lòng nhập giá sản phẩm.',
            'price.integer'=> 'Giá sản phẩm phải là một số.',
        ];
    }
}
