<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class Room extends Model
{
    protected $table = 'Classrooms';
    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo('Grade', 'Grade_id');
=======
use Spatie\Translatable\HasTranslations;

class Room extends Model
{


    public function Grade()
    {
        return $this->belongsTo(Grade::class);
>>>>>>> 8dc5858f80f0961c8066fb50164cfe12343569be
    }

}
?>
