<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            "Name_Section_Ar"=>"required",
            "Name_Section_En"=>"required",
            'Grade_id' => 'required',
            'Classroom_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
           'Name_Section_Ar.required' => trans('Sections_trans.required_ar'),
            'Name_Section_En.required' => trans('Sections_trans.required_en'),

            'Grade_id.required' => trans('Sections_trans.Grade_id_required'),
            'Classroom_id.required' => trans('Sections_trans.Class_id_required'),
               ];
    }
}
