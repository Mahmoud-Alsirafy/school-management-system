<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ["name"];
     protected $casts = [
        'name' => 'array',
    ];
    protected $guarded=[];

    public function gender(){
        return $this->belongsTo("App\Models\Gender","gender_id");
    }

    public function grade(){
        return $this->belongsTo("App\Models\Grade","Grade_id");
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Room', 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
    public function Nationality()
    {
        return $this->belongsTo('App\Models\Nationality', 'nationalitie_id');
    }

    public function myparent()
    {
        return $this->belongsTo('App\Models\My_Parent', 'parent_id');
    }

    public function images (){
        return $this->morphMany(Image::class,'imageable');
    }
     public function student_account()
    {
        return $this->hasMany('App\Models\StudentAccount', 'student_id');
    }
}
