<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait AttachFiles
{
    public function uploadFile($file, $model, $folder)
    {
        $fileName = now()->format('Ymd_His') . '_' . $file->getClientOriginalName();

        $path = $folder . '/' . $model->id;

        $file->storeAs(
            'attachments/' . $path,
            $fileName,
            'upload_attachments'
        );

        $model->images()->create([
            'filename' => $fileName,
            'path'     => $path,
        ]);

        return $fileName;
    }


    public function deleteFile($model, $folder)
    {
        $path = $folder . '/' . $model->id;
        $exists = Storage::disk('upload_attachments')->exists('attachments/'.$path);

        if($exists)
        {
            Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$path);
            Image::where('imageable_id', $model->id)->delete();
        }
    }

}
