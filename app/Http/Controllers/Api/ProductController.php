<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = $this->productService->getById($id);
        if (!$product) return response()->json(['message' => 'Not Found'], 404);
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, int $product_id)
    {
        $product = Product::findOrFail($product_id);
        $this->productService->update($product, $request->validated());

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
    }

    public function export()
    {
        $this->productService->exportToExcel();

        return response()->json([
           'message' => 'Экспорт товаров в execel в очереди'
        ],200);
    }
}
