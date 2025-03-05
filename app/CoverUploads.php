<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookCoverUploader
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function store()
    {
        $fileName = $this->generateFileName();
        $this->storeFile($fileName);

        return $fileName;
    }

    protected function generateFileName()
    {
        $extension = $this->file->getClientOriginalExtension();
        $fileBaseName = Str::uuid() . '.' . $extension;

        return $fileBaseName;
    }

    protected function storeFile($fileName)
    {
        Storage::putFileAs('public/uploads', $this->file, $fileName);
    }
}
