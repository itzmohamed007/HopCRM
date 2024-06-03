<?php

namespace App\Services\Specifications;

interface IOrganisationService
{
    /**
     * Check if a contact with the given name and surname is a duplicate.
     */
    public function isDuplicate(string $nom);

    /**
     * Store a new contact including associated organisation.
     */
    public function store(array $data);

    /**
     * Update an existing contact including associated organisation.
     */
    public function update(array $data);
}
