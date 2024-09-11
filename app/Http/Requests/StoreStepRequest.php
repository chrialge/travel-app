<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStepRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'date' => 'required',
            'image' => 'nullable|image',
            'travel_id' => 'required|exists:travel,id',
            'time_start' => 'required|size: 5',
            'time_arrived' => 'nullable|size: 5',
            'location' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
