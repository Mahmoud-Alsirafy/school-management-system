<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Grade_id'          => 'required|exists:grades,id',
            'Classroom_id'      => 'required|exists:classrooms,id',
            'section_id'        => 'required|exists:sections,id',
            'academic_year'     => 'required|digits:4',

            'Grade_id_new'      => 'required|exists:grades,id|different:Grade_id',
            'Classroom_id_new'  => 'required|exists:classrooms,id',
            'section_id_new'    => 'required|exists:sections,id',
            'academic_year_new' => 'required|digits:4|different:academic_year',
        ];
    }
}
