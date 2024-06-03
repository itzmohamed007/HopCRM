<?php

namespace App\Repositories\Specifications;

interface IOrganisationRepository
{
    /**
     * Store a new store organisation.
     */
    public function store(array $data);
    /**
     * Check if a organisation with the given name is a duplicate.
     */
    public function isDuplicate($nom);
    /**
     * Update an existing organisation.
     */
    public function update(array $data);
}
