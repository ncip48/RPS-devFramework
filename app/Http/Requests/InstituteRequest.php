<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:institutes',
            'password' => 'required|min:8',
            'address' => 'required',
            'phone' => 'required',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'logo' => 'image|max:2048',
            'id_product' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Jenis institusi harus diisi.',
            'name.required' => 'Nama institusi harus diisi.',
            'email.required' => 'Email institusi harus diisi.',
            'email.email' => 'Email institusi tidak valid.',
            'email.unique' => 'Email institusi sudah terdaftar.',
            'password.required' => 'Password institusi harus diisi.',
            'password.min' => 'Password institusi minimal 8 karakter.',
            'address.required' => 'Alamat institusi harus diisi.',
            'phone.required' => 'Nomor telepon institusi harus diisi.',
            'province.required' => 'Provinsi institusi harus diisi.',
            'city.required' => 'Kota institusi harus diisi.',
            'district.required' => 'Kecamatan institusi harus diisi.',
            'logo.image' => 'Logo institusi harus berupa gambar.',
            'logo.max' => 'Ukuran logo institusi maksimal 2 MB.',
            'id_product.required' => 'Produk harus diisi.',
        ];
    }
}
