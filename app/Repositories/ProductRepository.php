<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    protected $entity;

    public function __construct()
    {
        $this->entity = DB::table('products');
    }

    public function getAllLatest()
    {
        return $this->entity->latest()->paginate(request()->get('limit', 10));
    }

    public function getAll()
    {
        return $this->entity->get();
    }

    public function getBy($column, $data){
        return $this->entity->where($column, $data)->get();
    }
    
    public function getById(int $id)
    {
        return $this->entity->where('id', $id)->first();
    }

    public function store(array $data)
    {
        return $this->entity->insert($data);
    }

    public function update(array $data, int $id)
    {
        $object = Product::find($id);
        return $object->update($data);
        // return $this->entity->where('id', $id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->entity->where('id', $id)->delete();
    }

    public function searchProductReq($data){
        return $this->entity->whereRaw("(name LIKE '%".$data."%')")
                ->limit(30)
                ->get();
    }
}