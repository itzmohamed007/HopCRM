<?php

namespace App\Services;

use App\Repositories\Implementations\OrganisationRepository;
use App\Repositories\Implementations\ContactRepository;

class ContactService
{
    private ContactRepository $contactRepository;
    private OrganisationRepository $organisationRepository;

    public function __construct(ContactRepository $contactRepository, OrganisationRepository $organisationRepository)
    {
        $this->contactRepository = $contactRepository;
        $this->organisationRepository = $organisationRepository;
    }

    public function getAll() {
        return $this->contactRepository->index();
    }

    
}
