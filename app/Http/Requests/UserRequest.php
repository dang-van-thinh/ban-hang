<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email'=>'required|email',
            'phone_number'=>'required',
            //
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Không được để trống tên ',
            'email.required'=>'Không được để trống email',
            'email.email'=>'Sai định dạng email',
            'phone_number.required'=>'Không được để trống số điện thoại'
        ];
    }
}
