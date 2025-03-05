<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateBukuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'KategoriID' => 'sometimes|required|array|exists:kategoribuku,KategoriID',
            'Cover' => 'sometimes|nullable|image|max:2048',
            'Judul' => 'sometimes|required|string|max:255',
            'Deskripsi' => 'sometimes|required|max:1000',
            'Penulis' => 'sometimes|required|string|max:255',
            'Penerbit' => 'sometimes|required|string|max:255',
            'TahunTerbit' => 'sometimes|required|digits:4|date_format:Y',
        ];

        Log::info('Validation Rules:', $rules);

        return $rules;
    }
}
