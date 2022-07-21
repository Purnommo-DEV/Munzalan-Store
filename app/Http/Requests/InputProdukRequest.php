<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InputProdukRequest extends FormRequest
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
            'gambar1' => 'max:2040',
            'gambar2' => 'max:2040',
            'gambar3' => 'max:2040',
            'gambar4' => 'max:2040',
            'gambar5' => 'max:2040',
        ];
    }

    public function messages()
    {
        return [
            'gambar1.max' => 'Gambar Wajib di Bawah 2 MB',
            'gambar2.max' => 'Gambar Wajib di Bawah 2 MB',
            'gambar3.max' => 'Gambar Wajib di Bawah 2 MB',
            'gambar4.max' => 'Gambar Wajib di Bawah 2 MB',
            'gambar5.max' => 'Gambar Wajib di Bawah 2 MB',
        ];
    }
}
