<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the Contact resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'e_mail' => $this->e_mail,
            'organisation' => [
                'id' => $this->organisation->id,
                'nom' => $this->organisation->nom,
                'addresse' => $this->organisation->adresse,
                'code_postal' => $this->organisation->code_postal ?? null,
                'ville' => $this->organisation->ville ?? null,
                'statut' => $this->organisation->statut ?? null,
            ]
        ];
    }
}
