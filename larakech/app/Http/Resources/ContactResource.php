<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nom' => $this->nom,
            'e_mail' => $this->e_mail,
            'entreprise' => $this->organisation->nom,
            'organisation' => [
                'nom' => $this->organisation->nom,
                'adresse' => $this->organisation->adresse,
                'code_postal' => $this->organisation->code_postal ?? null,
                'ville' => $this->organisation->ville ?? null,
                'statut' => $this->organisation->statut ?? null,
            ]
        ];
    }
}
