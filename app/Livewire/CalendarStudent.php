<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class CalendarStudent extends Component
{
    public function fetchEvents()
    {
        return Event::select('id','title','start')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.calendarStudent');
    }
}
