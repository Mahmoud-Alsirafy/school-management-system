<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{
    protected $table = 'Classrooms';
    public $timestamps = true;

    public function Grades()
    {
        return $this->belongsTo('Grade', 'Grade_id');

    }

}
?>
