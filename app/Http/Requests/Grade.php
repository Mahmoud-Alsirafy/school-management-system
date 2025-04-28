<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Grade extends FormRequest
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
            "Name"=>"required|max:255",
            "Name_en"=>"required|max:255",
        ];
    }
    public function messages()
    {
        return [
            "Name.required"=>trans("validation.required"),
            "Notes.required"=>trans("validation.required"),
        ];
    }
}
