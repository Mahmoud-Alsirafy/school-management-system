<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo("App\Models\Grade", "Grade_id");
    }
    public function classroom()
    {
        return $this->belongsTo("App\Models\Room", "Classroom_id");
    }
    public function section()
    {
        return $this->belongsTo("App\Models\Section", "section_id");
    }
    public function teacher()
    {
        return $this->belongsTo("App\Models\Teacher", "teacher_id");
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
