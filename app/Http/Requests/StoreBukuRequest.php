<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'Judul' => 'required|string|max:255',
            'Penulis' => 'required|string|max:255',
            'TahunTerbit' => 'required|digits:4|date_format:Y',
            'KategoriID' => 'required|exists:kategoribuku,KategoriID',
        ];
    }
}
