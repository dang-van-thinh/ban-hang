<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangPasswordRequest extends FormRequest
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
            'oldPW'=>'required|min:8',
            'newPW'=>'required|min:8',
            'reNewPW'=>'required|same:newPW',

            //
        ];
    }
    public function messages(){
        return [
            'oldPW.required'=>'Nhập mật khẩu cũ của bạn !',
            'oldPW.min'=>'Mật khẩu phải có it nhất 8 ký tự!',
            'newPW.required'=>'Nhập mật khẩu mới của bạn !',
            'newPW.min'=>'Mật khẩu phải có it nhất 8 ký tự !',
            'reNewPW.required'=>'Nhập lại mật khẩu mới của bạn !',
            'reNewPW.same'=>'Mật khẩu nhập lại phải trùng với mật khẩu mới nhập !',
        ];
    }
}
