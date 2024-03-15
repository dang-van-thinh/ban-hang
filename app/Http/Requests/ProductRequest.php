<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'price'=>'required|numeric',
            'img'=>'nullable|required',
            'quanity'=>'required',
            'price_sale'=>'required',
            'description'=>'required',
            'rating'=>'integer',
            'category_id'=>'required'
        ];
    }
    public function messages(){
       return [
            'name.required'=>'Không được để trống trường tên sản phẩm !',
            'price.required'=>'Không được để trống ô giá !',
            'price.numeric'=>'Giá sản phẩm phải là số !',
            'img.required'=>'Chọn ảnh cho sản phẩm !',
            'quanity.required'=>'Không được để trống ô số lượng sản phẩm !',
            'price_sale.required'=>'Đừng để trống giá khuyến mãi. Nếu không có thì hãy điền 0 !',
            'description.required'=>'Không để trống trường mô tả !',
            'category_id.required'=>'Bạn phải chọn danh mục cho sản phẩm'
        ];
    }
}
