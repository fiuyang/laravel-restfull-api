<?php

namespace App\Http\Controllers\V1\API;

use App\Models\Product;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{
    use Response;

    protected $service;

    public function __construct(ProductService $service)
	{
		$this->service = $service;
	}

    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->successResponse(new ProductCollection($object), 'List Products');
    }


    public function store(ProductRequest $request)
    {
        $object = $this->service->insert($request->validated());
        return response()->json([
            'data' => $object,
            'message' => 'Product Inserted successfully',
            'code' => 200,
        ]);
        // return $this->successResponse($object, 'Product Inserted successfully', 200);
    }

    public function show($id)
    {
        $object = $this->service->getById($id);
        if(!$object) return $this->errorResponse(null, "Product Not Found", 404);

        return response()->json([
            'data' => new ProductResource($object),
            'message' => 'Product details',
            'code' => 200,
        ]);
        // return $this->successResponse(new ProductResource($object), 'Product Details', 200);
    }

    public function update(ProductRequest $request, $id)
    {
        $check = $this->service->getById($id);
        if(!$check) return $this->successResponse(null, "Product Not Found with ID {$id}", 404);

        $object = $this->service->update($request->all(), $id);
        return response()->json([
            'data' => new ProductResource($object),
            'message' => 'Product has been Updated',
            'code' => 200,
        ]);
        // return $this->successResponse(new ProductResource($object), "Product has been Updated");
    }

    public function destroy($id)
    {
        $check = $this->service->getById($id);            
        if(!$check) return $this->errorResponse(null, "Product Not Found with ID {$id}", 404);

        $object = $this->service->delete($id);
        return $this->successResponse($object, "Customer has been Deleted");
    }

    public function loadDataSearchReq(Request $request)
    {
        $data = $this->service->loadSearchProductReq($request->q);
        return $this->successResponse(new ProductResource($data), "Show Product By");
    }
}
