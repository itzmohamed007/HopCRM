<?php

namespace App\Repositories\Implementations;

use App\Exceptions\Customs\ModularException;
use App\Exceptions\GlobalExceptionHandler;
use App\Models\Organisation;
use App\Repositories\Specifications\IOrganisationRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class OrganisationRepository implements IOrganisationRepository
{
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
     * Find organisation duplicates by first name and last name.
     *
     * @param string $nom organisation name
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

    public function update(array $data)
    {
        try {
            $organisation = Organisation::findOrFail($data['id']);
            if ($organisation->update($data))
                return $organisation;
            abort(500, "Organisation update failed !");
        } catch (Exception $e) {
            Log::error("An error occured while updating an organisation: " . $e->getMessage());
            abort(500, $e->getMessage());        }
    }
}
