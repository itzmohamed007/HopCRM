<?php

namespace App\Services\Implementations;

use App\Repositories\Specifications\IOrganisationRepository;
use App\Services\Specifications\IOrganisationService;

class OrganisationService implements IOrganisationService
{
    private IOrganisationRepository $organisationRepository;

    /**
     * Dependency injection constructor, inject service dependencies
     * 
     * @param IOrganisationRepository $contactRepository contact-related operations repository interface
     */
    public function __construct(IOrganisationRepository $organisationRepository)
    {
        $this->organisationRepository = $organisationRepository;
    }

    /**
     * Check if an organisation with the given name is a duplicate.
     *
     * @param string $nom The name of the organisation.
     * @return bool True if the organisation is a duplicate, false otherwise.
     */
    public function isDuplicate(string $nom)
    {
        return $this->organisationRepository->isDuplicate($nom);
    }

    /**
     * Store a new organisation.
     *
     * @param array $data The data to create the organisation with.
     * @return \App\Models\Organisation The created organisation.
     */
    public function store(array $data)
    {
        return $this->organisationRepository->store($data);
    }

    /**
     * Update an existing organisation.
     *
     * @param array $data The data to update the organisation with.
     * @return \App\Models\Organisation The updated organisation.
     */
    public function update(array $data)
    {
        return $this->organisationRepository->update($data);
    }
}
