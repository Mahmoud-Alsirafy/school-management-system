<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = ['Name'];
    protected $table = 'nationalitys'; // أو 'nationality' إذا كان هذا هو الاسم الصحيح
}
