<?php

namespace carolezountangni\LogSupervisor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'created_at' => ['nullable', 'date_format:d/m/Y'],
            'title' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'created_at.date_format' => 'Le champ date doit être au format JJ/MM/AAAA.',
            'title.max' => 'Le titre ne doit pas dépasser :max caractères.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Formatage de la date pour correspondre au format de la BDD
        if ($this->has('created_at')) {
            $this->merge([
                'created_at' => \Carbon\Carbon::createFromFormat('d/m/Y', $this->created_at)->format('Y-m-d'),
            ]);
        }
    }
}
