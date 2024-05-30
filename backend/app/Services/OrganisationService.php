<?php

namespace App\Services;

use App\Exceptions\GlobalExceptionHandler;
use App\Models\Organisation;
use App\Repositories\Specifications\IOrganisationRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class OrganisationService
{
    private IOrganisationRepository $organisationRepository;

    public function __construct(IOrganisationRepository $organisationRepository)
    {
        $this->organisationRepository = $organisationRepository;
    }

    public function isDuplicate(string $nom): bool
    {
        return $this->organisationRepository->isDuplicate($nom);
    }

    public function update(array $data)
    {
        return $this->organisationRepository->update($data);
    }
}
