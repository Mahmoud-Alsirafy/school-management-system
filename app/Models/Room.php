<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Room extends Model
{


    public function Grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
?>
