<?php 
namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductRepositoryInterface;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllLatest()
    {
        return $this->repo->getAllLatest();
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getBy($column, $data)
    {
        return $this->repo->getBy($column, $data);
    }
    
    public function getById(int $id)
    {
        return $this->repo->getById($id);
    }

    public function insert(array $data)
    {
        return $this->repo->store($data);
    }

    public function update(array $data, int $id)
    {
        return $this->repo->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->repo->destroy($id);
    }

    public function loadSearchProductReq($data)
    {
        return $this->repo->searchProductReq($data);
    }
}

