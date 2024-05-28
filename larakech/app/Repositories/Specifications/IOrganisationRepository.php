<?php

namespace App\Repositories\Specifications;

use App\Http\Requests\OrganisationRequest;
use App\Models\Organisation;

interface IOrganisationRepository
{
    public function findOrCreate(array $data);
}
