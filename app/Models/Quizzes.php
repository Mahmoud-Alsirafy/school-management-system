<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizzes extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];
    public function teacher () {
        return $this->belongsTo("App\Models\Teacher","Teacher_id");
    }
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
