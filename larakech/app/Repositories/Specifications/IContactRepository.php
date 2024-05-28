<?php

namespace App\Repositories\Specifications;

use App\Http\Requests\ContactRequest;

interface IContactRepository
{
    public function index();
    public function getById($id);
    public function store(ContactRequest $contactRequest);
    public function update(ContactRequest $contactRequest, $id);
    public function delete($id);
}
