<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

trait UploadCover
{
    public function uploadCover(Request $request, $model)
    {
        $currentCover = $model->Cover;

        if ($request->hasFile('Cover')) {
            $coverFile = $request->file('Cover');

            // Validasi file Cover secara manual
            $validator = Validator::make(['Cover' => $coverFile], ['Cover' => 'image|max:2048']);
            if ($validator->fails()) {
                return $validator->errors()->toArray();
            }

            // Simpan file Cover baru dengan nama file asli
            $coverFileName = $coverFile->getClientOriginalName();
            $coverFile->storeAs('public/uploads', $coverFileName);

            // Hapus Cover lama jika ada
            if ($currentCover && Storage::disk('public')->exists('uploads/' . $currentCover)) {
                Storage::disk('public')->delete('uploads/' . $currentCover);
            }

            return $coverFileName;
        }

        return $currentCover;
    }
}
