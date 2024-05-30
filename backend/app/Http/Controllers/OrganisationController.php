<?php

namespace App\Http\Controllers;

use App\Services\OrganisationService;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    private OrganisationService $organisationService;

    public function __construct(OrganisationService $organisationService)
    {
        $this->organisationService = $organisationService;
    }

    public function isDuplicate(Request $request) {
        $validated = $request->validate([
            'nom' => 'required|alpha'
        ]);

        return response()->json($this->organisationService->isDuplicate($validated['nom']));
    }
}
