<?php 
namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepository $repo)
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
    
    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function insert(ProductRequest $request)
    {
        return $this->repo->store($request->all());
    }

    public function update(ProductRequest $request, $id)
    {
        return $this->repo->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->repo->destroy($id);
    }

    public function loadSearchProductReq($data)
    {
        return $this->repo->searchProductReq($data);
    }
}

