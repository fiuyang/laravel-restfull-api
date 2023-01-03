<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllLatest();

    public function getAll();

    public function getBy($column, $data);

    public function getById(int $id);

    public function store(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);

    public function searchProductReq($data);
}