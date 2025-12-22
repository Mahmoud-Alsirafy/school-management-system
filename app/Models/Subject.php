<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;
     public $translatable=['Name'];
     protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo("App\Models\Grade", "Grade_id");
    }
    public function classroom()
    {
        return $this->belongsTo('App\Models\Room', 'Classroom_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'Teacher_id');
    }
}
