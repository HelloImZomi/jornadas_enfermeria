<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InscriptionUpdateRequest extends FormRequest
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
            'convocation_id' => ['required', 'exists:convocations,id'],
            'school_id' => ['required', 'exists:schools,id'],
            'code' => [
                'required',
                Rule::unique('inscriptions', 'code')->ignore(
                    $this->inscription
                ),
                'max:8',
            ],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'education' => ['required', 'in:1,2,3'],
            'modality' => ['required', 'in:1,2'],
            'receipt_path' => ['file', 'max:1024', 'nullable'],
            'approved' => ['nullable', 'boolean'],
        ];
    }
}
