<?php

namespace App\Services\Implementations;

use App\Repositories\Implementations\ContactRepository;
use App\Repositories\Specifications\IContactRepository;
use App\Services\Specifications\IContactService;
use App\Services\Specifications\IOrganisationService;
use Exception;
use Illuminate\Support\Facades\Log;

class ContactService implements IContactService
{
    private ContactRepository $contactRepository;
    private OrganisationService $organisationService;

    /**
     * Dependency injection constructor, inject service dependencies
     * 
     * @param ContactRepository $contactRepository contact-related operations repositry
     * @param OrganisationService $organisationService contact-related operations service (single responsibility)
     */
    public function __construct(
        IContactRepository $contactRepository,
        IOrganisationService $organisationService
    ) {
        $this->contactRepository = $contactRepository;
        $this->organisationService = $organisationService;
    }

    /**
     * Retrieve all contacts.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of contacts.
     */
    public function getAll()
    {
        return $this->contactRepository->index();
    }

    /**
     * Retrieve a single contact by id.
     *
     * @param int $id The ID of the contact to retrieve.
     * @return \App\Models\Contact|null The contact object or null if not found.
     */
    public function getById($id)
    {
        return $this->contactRepository->getById($id);
    }

    /**
     * Search for contacts by name, surname, or organisation name.
     *
     * @param string $target The search keyword.
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of search results.
     */
    public function search($target)
    {
        return $this->contactRepository->search($target);
    }

    /**
     * Check if a contact with the given name and surname is a duplicate.
     *
     * @param string $nom The name of the contact.
     * @param string $prenom The surname of the contact.
     * @return bool True if the contact is a duplicate, false otherwise.
     */
    public function isDuplicate($nom, $prenom)
    {
        return $this->contactRepository->isDuplicate($nom, $prenom);
    }

    /**
     * Store a new contact including associated organisation.
     *
     * @param array $data The data to create the contact with.
     * @return \App\Models\Contact The created contact.
     * @throws \Exception If an error occurs while creating the contact.
     */
    public function store(array $data)
    {
        try {
            $organisationRequest = $data['organisation'];
            $organisation = $this->organisationService->store($organisationRequest);

            $data['e_mail'] = strtolower($data['e_mail']);
            $data['nom'] = ucwords($data['nom']);
            $data['prenom'] = ucwords($data['prenom']);
            $data['organisation_id'] = $organisation->id;

            $contact = $this->contactRepository->store($data);

            return $contact;
        } catch (Exception $e) {
            Log::error('An error occurred while creating a new contact: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Update an existing contact including associated organisation.
     *
     * @param array $data The data to update the contact with.
     * @return \App\Models\Contact The updated contact.
     * @throws \Exception If an error occurs while updating the contact.
     */
    public function update(array $data)
    {
        try {
            $organisationRequest = $data['organisation'];;
            $organisation = $this->organisationService->update($organisationRequest);

            $data['organisation_id'] = $organisation->id;

            $contact = $this->contactRepository->update($data, $data['id']);

            return $contact;
        } catch (Exception $e) {
            Log::error('An error occurred while creating a new contact: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Delete a contact by its ID.
     *
     * @param array $data The data containing the ID of the contact to delete.
     * @return void
     */
    public function delete($id)
    {
        $this->contactRepository->delete($id);
    }
}
