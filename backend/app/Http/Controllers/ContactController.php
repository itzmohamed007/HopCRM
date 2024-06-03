<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactDeleteRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactResource;
use App\Services\Implementations\ContactService;
use App\Services\Specifications\IContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @var ContactService The service responsible for contact-related operations.
     */
    private ContactService $contactService;

    /**
     * Dependency injection constructor, inject controller dependencies
     *
     * @param ContactService $contactService The service to be injected for contact-related operations.
     */
    public function __construct(IContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a paginated listing of the contacts.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ContactResource::collection($this->contactService->getAll());
    }

    /**
     * Search for contacts by a given target.
     *
     * @param string $target The target string to search contacts by.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search($target)
    {
        return ContactResource::collection($this->contactService->search($target));
    }

    /**
     * Check if a contact with given name and surname is a duplicate.
     *
     * @param Request $request The request containing 'nom' and 'prenom' to search for
     * @return \Illuminate\Http\JsonResponse
     */
    public function isDuplicate(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|alpha',
            'prenom' => 'required|alpha'
        ]);

        return response()->json($this->contactService->isDuplicate($validated['nom'], $validated['prenom']));
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param ContactCreateRequest $request The validated request containing contact creation data.
     * @return ContactResource
     */
    public function store(ContactCreateRequest $request)
    {
        return new ContactResource($this->contactService->store($request->all()));
    }

    /**
     * Display the specified contact.
     *
     * @param string $id The ID of the contact to display.
     * @return ContactResource|\Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $contact = $this->contactService->getById($id);
        return $contact !== null
            ? new ContactResource($contact)
            : response()->json(['data' => 'null'], 404);
    }

    /**
     * Update the specified contact in storage.
     *
     * @param ContactUpdateRequest $request The validated request containing contact update data.
     * @return ContactResource
     */
    public function update(ContactUpdateRequest $request)
    {
        $contact = $this->contactService->update($request->all());
        return new ContactResource($contact);
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param ContactDeleteRequest $request The validated request containing contact deletion data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ContactDeleteRequest $request)
    {
        $this->contactService->delete($request->input('id'));
        return response()->json(null, 204);
    }
}
