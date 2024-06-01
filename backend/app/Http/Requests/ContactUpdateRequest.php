<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
            'nom' => 'required|alpha',
            'prenom' => 'required|alpha',
            'e_mail' => 'required|email',
            'organisation' => 'required|array',
            'organisation.id' => 'required|numeric',
            'organisation.nom' => 'required|alpha_num',
            'organisation.code_postal' => 'nullable|numeric',
            'organisation.ville' => 'nullable|alpha',
            'organisation.statut' => 'nullable|in:LEAD,CLIENT,PROSPECT'
        ];
    }
}
