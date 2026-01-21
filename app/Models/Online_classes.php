<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Online_classes extends Model
{
    protected $guarded = [];
    public function grade () {
        return $this->belongsTo("App\Models\Grade","Grade_id");
    }
    public function classroom () {
        return $this->belongsTo("App\Models\Room","Classroom_id");
    }
    public function section () {
        return $this->belongsTo("App\Models\Section","section_id");
    }
}
