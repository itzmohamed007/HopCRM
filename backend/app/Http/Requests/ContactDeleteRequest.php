<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactDeleteRequest extends FormRequest
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
            'id' => 'required|numeric',
            'nom' => 'required',
            'prenom' => 'required',
            'e_mail' => 'required',
            'organisation' => 'required',
            'organisation.nom' => 'required',
            'organisation.code_postal' => 'nullable',
            'organisation.ville' => 'nullable',
            'organisation.statut' => 'nullable'
        ];
    }
}
