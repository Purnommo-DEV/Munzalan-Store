<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputRegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',  
        ];
    }
    public function messages()
    {
        return [
            'email.unique'    => 'E-mail Telah Terdaftar, Coba Lagi',
            'password.min'    => 'Password Minimal 8 Karakter',
            'required'        => 'Wajib di isi',
        ];
    }
}
