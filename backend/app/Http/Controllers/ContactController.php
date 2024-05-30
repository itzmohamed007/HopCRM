<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactResource::collection($this->contactService->getAll());
    }

    public function isDuplicate(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|alpha',
            'prenom' => 'required|alpha'
        ]);

        return response()->json($this->contactService->isDuplicate($validated['nom'], $validated['prenom']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        return new ContactResource($this->contactService->store($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = $this->contactService->getById($id);
        return $contact !== null
            ? new ContactResource($contact)
            : response()->json(['data' => 'null'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request)
    {
        $contact = $this->contactService->update($request);
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactRequest $request)
    {
        $this->contactService->delete($request);
        return response()->json(null, 200);
    }
}
