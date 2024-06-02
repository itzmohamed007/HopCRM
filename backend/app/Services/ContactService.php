<?php

namespace App\Services;

use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactDeleteRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Repositories\Implementations\OrganisationRepository;
use App\Repositories\Implementations\ContactRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ContactService
{
    private ContactRepository $contactRepository;
    private OrganisationService $organisationService;
    private OrganisationRepository $organisationRepository;

    public function __construct(
        ContactRepository $contactRepository,
        OrganisationService $organisationService,
        OrganisationRepository $organisationRepository
    ) {
        $this->contactRepository = $contactRepository;
        $this->organisationService = $organisationService;
        $this->organisationRepository = $organisationRepository;
    }

    public function getAll()
    {
        return $this->contactRepository->index();
    }

    public function search($target) {
        return $this->contactRepository->search($target);
    }

    public function isDuplicate($nom, $prenom): bool
    {
        return $this->contactRepository->isDuplicate($nom, $prenom);
    }

    public function store(ContactCreateRequest $request)
    {
        try {
            $organisationRequest = $request->input('organisation');
            $organisation = $this->organisationRepository->store($organisationRequest);

            $data = $request->all();
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

    public function update(ContactUpdateRequest $request)
    {
        try {
            $organisationRequest = $request->input('organisation');
            $organisation = $this->organisationService->update($organisationRequest);

            $data = $request->all();
            $data['organisation_id'] = $organisation->id;

            $contact = $this->contactRepository->update($data, $data['id']);

            return $contact;
        } catch (Exception $e) {
            Log::error('An error occurred while creating a new contact: ' . $e->getMessage());
            abort(500, $e->getMessage());        }
    }

    public function getById($id)
    {
        return $this->contactRepository->getById($id);
    }

    public function delete(ContactDeleteRequest $request) {
        $this->contactRepository->delete($request->input('id'));
    }
}
