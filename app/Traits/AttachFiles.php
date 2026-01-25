<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

trait AttachFiles
{
    public function uploadFile($file, $model, $folder)
    {
        $fileName = $file->getClientOriginalName();

        $file->storeAs('attachments/' ,$folder."/".$model->id."/". $fileName,'upload_attachments');
        
        
        $model->images()->create([
            'filename' => $fileName,
        ]);

    }


    public function deleteFile($id, $folder)
    {
        
        $exists = Storage::disk('upload_attachments')->exists('attachments/',$folder."/".$id);

        if($exists)
        {
            Storage::disk('upload_attachments')->deleteDirectory('attachments/',$folder."/".$id);
            Image::where('imageable_id', $id)->delete();
        }
    }

}
