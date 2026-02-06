<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public function fetchEvents()
    {
        return Event::select('id','title','start')->get()->toArray();
    }

    public function addevent($event)
    {
        Event::create($event);
    }

    public function updateEvent($id, $start)
    {
        Event::where('id', $id)->update(['start' => $start]);
    }

    public function deleteEvent($id)
    {
        Event::where('id', $id)->delete();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
