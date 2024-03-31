<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class OrderRequest extends FormRequest
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
        $rules =  [
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|numeric|digits:10|unique:users,phone_number',
            'address'=>'required|max:155',
            'provinces'=>'required',
            'districts'=>'required',
            'wards'=>'required',
            'pay'=>'required'
            //
        ];
        // điều kiện để thay đổi validate
        if(Auth::id()){
            $rules['email'] = 'email|required';
            $rules['phone'] = 'required|numeric|digits:10';
        }
        return $rules;
    }
    public function messages(){
        return [
            'name.required'=>'Không được để trống tên người nhận !',
            'email.required'=>'Không được để trống email người nhận !',
            'email.email'=>'Không đúng định dạng email ! Ví dụ : abc@gmail.com',
            'email.unique'=>'Email đã tồn tại ,Vui lòng đăng nhập !',
            'phone.required'=>'Không được để trống số điện thoại người nhận !',
            'phone.numeric'=>'Số điện thoại phải là số !',
            'phone.unique'=>'Số điện thoại đã tồn tại , Vui lòng đăng nhập',
            'phone.digits'=>'Số điện thoại phải có ít nhất 10 số !',
            'address.required'=>'Không được để trống địa chỉ nhà !',
            'provinces.required'=>'Chọn tỉnh/thành phố của bạn !',
            'districts.required'=>'Chọn quận/huyện của bạn !',
            'wards.required'=>'Chọn xã/phường của bạn !',
            'pay.required'=>'Chọn phương thức thanh toán cho đơn hàng này !'
        ];
    }
}
