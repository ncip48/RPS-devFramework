<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_institute' => 'required|exists:institutes,id',
            'name' => 'required',
            'nip' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_institute.required' => 'Institusi harus diisi.',
            'id_institute.exists' => 'Institusi tidak valid.',
            'name.required' => 'Nama harus diisi.',
            'nip.required' => 'NIP harus diisi.',
        ];
    }
}
