<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvocationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'inscription_start_date' => ['nullable', 'date'],
            'inscription_end_date' => ['nullable', 'date'],
            'start_time' => ['nullable', 'date'],
            'end_time' => ['nullable', 'date'],
            'presencial_limit' => ['nullable', 'max:255'],
            'virtual_limit' => ['nullable', 'max:255'],
            'zoom_url' => ['nullable', 'max:255', 'string'],
            'whatsapp_url' => ['nullable', 'max:255', 'string'],
            'logo_path' => ['file', 'max:1024', 'nullable'],
        ];
    }
}
