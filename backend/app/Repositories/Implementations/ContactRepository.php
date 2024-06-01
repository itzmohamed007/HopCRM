<?php

namespace App\Repositories\Implementations;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Repositories\Specifications\IContactRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ContactRepository implements IContactRepository
{
    /**
     * Retrieve all contacts.
     *
     * @return
     */
    public function index()
    {
        return Contact::paginate(10);
    }

    /**
     * Retrieve a single conatact by id.
     *
     * @param integer $id contact's primary key
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getById($id)
    {
        try {
            return Contact::find($id);
        } catch (Exception $e) {
            Log::error('an error occured while fetching contact: ' + $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Find contact duplicates by first name and last name.
     *
     * @param string $nom Last name
     * @param string $prenom First name
     * @return boolean
     */
    public function isDuplicate($nom, $prenom): bool
    {
        try {
            $contact = Contact::where('nom', '=', $nom)
                ->where('prenom', '=', $prenom)
                ->first();
            return $contact !== null;
        } catch (Exception $e) {
            Log::error("a error occured while searching for contact duplicates: " . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Store a new contact.
     *
     * @param array $data contact 
     * @return \App\Models\Contact
     * @throws \Exception
     */
    public function store(array $data)
    {
        try {
            return Contact::create($data);
        } catch (Exception $e) {
            Log::error('an error occured while creating a new contact: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Update an existing contact.
     *
     * @param array $data contact data
     * @param int $id
     * @return \App\Models\Contact
     * @throws \Exception
     */
    public function update(array $data, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->update($data);
            return $contact;
        } catch (Exception $e) {
            Log::error('an error occured while updating a contact: ' . $e->getMessage());
            abort(500, $e->getMessage());
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
        } catch (Exception $e) {
            Log::error('Error deleting contact: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
