<?php

namespace App\Http\Controllers;

use App\Services\Implementations\OrganisationService;
use App\Services\Specifications\IOrganisationService;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    /**
     * @var OrganisationService The service responsible for organisation-related operations.
     */
    private OrganisationService $organisationService;

    /**
     * Dependency injection constructor, inject controller dependencies
     *
     * @param OrganisationService $organisationService The service to be injected for organisation-related operations.
     */
    public function __construct(IOrganisationService $organisationService)
    {
        $this->organisationService = $organisationService;
    }

    /**
     * Check if an organisation with the given name is a duplicate.
     *
     * @param Request $request The request containing 'nom'.
     * @return \Illuminate\Http\JsonResponse
     */
    public function isDuplicate(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|alpha'
        ]);

        return response()->json($this->organisationService->isDuplicate($validated['nom']));
    }
}
