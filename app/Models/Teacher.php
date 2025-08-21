<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];

    public function Specializations (){
        return $this->belongsTo('App\Models\Specialization','Specialization_id');
    }

    public function Genders (){
        return $this->belongsTo('App\Models\Gender','Gender_id');
    }

    public function section (){
        return $this->belongsToMany('App\Models\Section','teacher_section');
    }
}
