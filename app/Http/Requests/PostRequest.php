<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Reguły walidacji dla tworzenia posta
        $createRules = [
            'topic' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        // Reguły walidacji dla aktualizacji posta
        $updateRules = [
            'topic' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
        ];

        // Zwróć odpowiednie reguły w zależności od rodzaju operacji (create lub update)
        if ($this->isMethod('post')) {
            return $createRules;
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return $updateRules;
        }

        // W przeciwnym razie zwróć puste reguły
        return [];
    }
}
