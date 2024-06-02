<?php

namespace App\Repositories\Specifications;

interface IContactRepository
{
    public function index();
    public function getById($id);
    public function search($target);
    public function isDuplicate($nom, $prenom);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
