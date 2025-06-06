<?php

namespace App\Models;

use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = [
        'Name',
        'Name_en',
        'Notes'
    ];
    protected $table = 'Grades';
    public $timestamps = true;

    public function Sections()
    {
        return $this->hasMany('App\Models\Section', 'Grade_id');
    }
}
