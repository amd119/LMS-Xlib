<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoribukuStoreRequest extends FormRequest
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
            'NamaKategori' => 'required|string|max:255|unique:kategoribuku,NamaKategori',
        ];
    }

    public function messages(): array
    {
        return [
            'NamaKategori.required' => 'Nama Kategori tidak boleh kosong.',
            'NamaKategori.max' => 'Nama Kategori maksimal 255 karakter.',
            'NamaKategori.unique' => 'Nama Kategori sudah ada, silakan gunakan nama lain.',
        ];
    }
}
