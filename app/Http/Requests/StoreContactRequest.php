<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:120'],
            'company' => ['required', 'string', 'in:'.implode(',', array_keys(config('contact.companies')))],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\-\s]{7,30}$/'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
            'website' => ['prohibited'],
        ];
    }

    public function attributes(): array {
        return [
            'name' => 'nombre completo',
            'company' => 'empresa',
            'phone' => 'teléfono',
            'email' => 'correo electrónico',
            'message' => 'mensaje',
        ];
    }

    public function messages(): array {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'email' => 'Escribe un :attribute válido.',
            'in' => 'Selecciona una :attribute válida.',
            'phone.regex' => 'El :attribute no parece válido.',
            'website.prohibited' => 'No se pudo enviar el formulario.',
        ];
    }
}
