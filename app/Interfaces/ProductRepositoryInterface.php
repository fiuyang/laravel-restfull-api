<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllLatest();

    public function getAll();

    public function getBy($column, $data);

    public function getById($id);

    public function store(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function searchProductReq($data);
}