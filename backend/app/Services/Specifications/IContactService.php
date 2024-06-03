<?php

namespace App\Services\Specifications;

interface IContactService
{
    /**
     * Retrieve all contacts.
     */
    public function getAll();

    /**
     * Retrieve a contact by its ID.
     */
    public function getById($id);

    /**
     * Search for target by name, surname and organisation name
     */
    public function search($target);

    /**
     * Check if a contact with the given name and surname is a duplicate.
     */
    public function isDuplicate($nom, $prenom);

    /**
     * Store a new contact including associated organisation.
     */
    public function store(array $data);

    /**
     * Update an existing contact including associated organisation.
     */
    public function update(array $data);

    /**
     * Delete a contact by its ID.
     */
    public function delete($id);
}
