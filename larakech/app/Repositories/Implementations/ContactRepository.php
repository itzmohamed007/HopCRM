<?php

namespace App\Repositories\Implementations;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Repositories\Specifications\IContactRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ContactRepository implements IContactRepository
{
    /**
     * Retrieve all contacts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Contact::all();
    }

    /**
     * Retrieve a contact by its ID.
     *
     * @param int $id contact primary key
     * @return \App\Models\Contact|null
     */
    public function getById($id)
    {
        return Contact::find($id);
    }

    /**
     * Store a new contact.
     *
     * @param ContactRequest $contactRequest contact body
     * @return \App\Models\Contact
     * @throws \Exception
     */
    public function store(ContactRequest $contactRequest)
    {
        try {
            return Contact::create($contactRequest->validated());
        } catch (Exception $e) {
            Log::error('an error occured while creating a new contact: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update an existing contact.
     *
     * @param ContactRequest $contactRequest
     * @param int $id
     * @return \App\Models\Contact
     * @throws \Exception
     */
    public function update(ContactRequest $contactRequest, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->update($contactRequest->validated());
            return $contact;
        } catch(ModelNotFoundException $e) {
            Log::error('contact not found: ' . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            Log::error('an error occured while updating a contact: ' . $e->getMessage());
            throw $e;
        }
    }

    
    /**
     * Delete a contact by its ID.
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            return $contact->delete();
        } catch (ModelNotFoundException $e) {
            Log::error('Contact not found: ' . $e->getMessage());
            throw $e;
        } catch (Exception $e) {
            Log::error('Error deleting contact: ' . $e->getMessage());
            throw $e;
        }
    }
}
