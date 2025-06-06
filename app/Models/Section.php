<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{

    use HasTranslations;

    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Classroom_id','Status'];

    protected $table = 'Sections';
    public $timestamps = true;

     // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

     public function My_classs()
     {
         return $this->belongsTo('App\Models\Room', 'Classroom_id');
     }

    //  علاقة الاقسام مع المعلمين
     public function teachers()
     {
         return $this->belongsToMany('App\Models\Teacher','teacher_section');
     }

     public function Grades()
     {
         return $this->belongsTo('App\Models\Grade','Grade_id');
     }
}
