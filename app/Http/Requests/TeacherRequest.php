<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'Email'=>'required|unique:teachers,Email,'.$this->id,
            'Password'=>'required|string|max:12',
            'Name_ar'=>'required|string',
            'Name_en'=>'required|string',
            'Specialization_id'=>'required|string',
            'Gender_id'=>'required|string',
            'Joining_Date'=>'required|date',
            'Address'=>'required|max:50|string'
        ];
    }
    public function messages()
    {
        return [
            'Name_ar.required' => trans('validation.required'),
            'Name_en.required' => trans('validation.required'),
        ];
    }
}
