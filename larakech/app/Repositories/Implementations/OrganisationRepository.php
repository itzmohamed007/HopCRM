<?php

namespace App\Repositories\Implementations;

use App\Models\Organisation;
use App\Repositories\Specifications\IOrganisationRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class OrganisationRepository implements IOrganisationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * finds or creates an organisation by its name
     * 
     * @param string $nom organisation name
     * @return Organisation found/created organisation
     */
    public function findOrCreate(array $data)
    {
        try {
            return Organisation::firstOrCreate(['nom' => $data['nom']], $data);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
