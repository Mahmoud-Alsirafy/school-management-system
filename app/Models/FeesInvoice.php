<?php

namespace App\Models;

use App\Models\Fees;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class FeesInvoice extends Model
{
    protected $guarded = [];

        public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Room', 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fees', 'fee_id');
    }
}
