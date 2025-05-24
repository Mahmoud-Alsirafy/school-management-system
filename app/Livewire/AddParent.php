<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Religion;
use App\Models\Type_Blood;
use App\Models\Nationality;

class AddParent extends Component
{
    public $successMessage = '';

    public $catchError, $updateMode = false, $photos, $show_table = true, $Parent_id;

    public $currentStep = 1,

        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'Email' => ['required', 'string', 'email'],
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Type_Bloods' => Type_Blood::all(),
            'Religions' => Religion::all(),
        ]);
    }
    public function showformadd()
    {
        $this->show_table = false;
    }
    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|unique:my__parents,email,',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,',
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }
}
