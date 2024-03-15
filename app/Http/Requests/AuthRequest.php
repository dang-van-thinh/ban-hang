<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email'=>'required|email',
            'pw'=>'required|min:8'
            //
        ];
    }
    public function messages(){
        return [
            'email.required'=>'Không được để trống trường email người dùng !',
            'email.email'=>'Không đúng định dạng email',
            'pw.required'=>'Không được để trống trường mật khẩu !',
            'pw.min'=>'Độ dài mật khẩu phải từ 8 ký tự'
        ];
    }
}
