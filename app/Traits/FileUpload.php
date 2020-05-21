<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUpload
{
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : 'dudsf.'.Carbon::now()->format('YmdHs');
        return $file->storeAs(
            $folder,
            $name.".".$file->getClientOriginalExtension(),
            $disk
        );
    }

    public function deleteOne($path = null, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}
