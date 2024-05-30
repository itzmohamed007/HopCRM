<?php

namespace App\Repositories\Specifications;

interface IOrganisationRepository
{
    public function store(array $data);
    public function isDuplicate($nom);
    public function update(array $data);
}
