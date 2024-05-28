<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactService $contactService;

    public function __construct(ContactService $contactService) {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactResource::collection($this->contactService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
