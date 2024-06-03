<?php

namespace App\Repositories\Implementations;

use App\Models\Organisation;
use App\Repositories\Specifications\IOrganisationRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class OrganisationRepository implements IOrganisationRepository
{
    /**
     * Store a new organisation.
     *
     * @param array $data The data to create the organisation with.
     * @return \App\Models\Organisation The created organisation.
     */
    public function store(array $data)
    {
        try {
            return Organisation::create($data);
        } catch (Exception $e) {
            Log::error('an error occured while creating a new organisation: ' . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Check if an organisation with the given name is a duplicate.
     *
     * @param string $nom The name of the organisation.
     * @return bool True if the organisation is a duplicate, false otherwise.
     */
    public function isDuplicate($nom)
    {
        try {
            $organisation = Organisation::where('nom', '=', $nom)->first();
            return $organisation !== null;
        } catch (Exception $e) {
            Log::error("an error occured while searching for organisation duplicates: " . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    /**
     * Update an existing organisation.
     *
     * @param array $data The data to update the organisation with.
     * @return \App\Models\Organisation The updated organisation.
     */
    public function update(array $data)
    {
        try {
            $organisation = Organisation::findOrFail($data['id']);
            if ($organisation->update($data))
                return $organisation;
            abort(500, "Organisation update failed !");
        } catch (Exception $e) {
            Log::error("An error occured while updating an organisation: " . $e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
