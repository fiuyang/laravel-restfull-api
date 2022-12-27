<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAllLatest()
    {
        return DB::table('products')->latest()->paginate(request()->get('limit', 10));
    }

    public function getAll()
    {
        return DB::table('products')->get();
    }

    public function getBy($column, $data){
        return DB::table('products')->where($column, $data)->get();
    }
    
    public function getById($id)
    {
        return DB::table('products')->where('id', $id)->first();
    }

    public function store(array $data)
    {
        // return Product::create($data);
        return DB::table('products')->insert($data);
    }

    public function update(array $data, $id)
    {
        return DB::table('products')->where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        return DB::table('products')->where('id', $id)->delete();
    }

    public function searchProductReq($data){
        return DB::table('products')->whereRaw("(name LIKE '%".$data."%')")
                ->limit(30)
                ->get();
    }
}