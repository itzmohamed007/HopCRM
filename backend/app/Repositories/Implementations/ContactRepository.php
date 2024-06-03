<?php

namespace App\Repositories\Implementations;

use App\Models\Contact;
use App\Repositories\Specifications\IContactRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ContactRepository implements IContactRepository
{
    /**
     * Retrieve all contacts.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of contacts.
     */
    public function index()
    {
        return Contact::paginate(10);
    }

    /**
     * Retrieve a single contact by id.
     *
     * @param int $id The ID of the contact to retrieve.
     * @return \App\Models\Contact|null The contact object or null if not found.
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
     * Search for target by name, surname, and organisation name.
     *
     * @param string $target The search keyword.
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated list of search results.
     * @throws \Exception If an error occurs during the search.
     */
    public function search($target)
    {
        try {
            return Contact::where('nom', 'LIKE', '%' . $target . '%')
                ->orWhere('prenom', 'LIKE', '%' . $target . '%')
                ->orWhereHas('organisation', function ($query) use ($target) {
                    $query->where('nom', 'LIKE', '%' . $target . '%');
                })
                ->paginate(10);
        } catch (Exception $e) {
            Log::error('An error occurred while searching for ' . $target . ': ' . $e->getMessage());
            throw $e;
        }
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
     * Store a new contact including associated organisation.
     *
     * @param array $data The data to create the contact with.
     * @return \App\Models\Contact The created contact.
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
     * Update an existing contact including associated organisation.
     *
     * @param array $data The data to update the contact with.
     * @param int $id The ID of the contact to update.
     * @return \App\Models\Contact The updated contact.
     */
    public function update(array $data)
    {
        try {
            $contact = Contact::findOrFail($data['id']);
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
     * @param int $id The ID of the contact to delete.
     * @return bool|null True if the contact was deleted, null otherwise.
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
