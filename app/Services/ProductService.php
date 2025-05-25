<?php

namespace App\Services;

use App\Jobs\ExportProductsToExcel;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductService
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll(): Collection
    {
        return $this->productRepository->all();
    }

    public function getById(int $id): Product
    {
        return $this->productRepository->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function update(Product $product, array $data): Product
    {
        return $this->productRepository->update($product, $data);
    }

    public function delete(Product $product): void
    {
        $this->productRepository->delete($product);
    }

    public function exportToExcel(): void
    {
        $filename = 'exports/products_export_' . now()->format('Y-m-d') . '.xlsx';
        ExportProductsToExcel::dispatch($filename);
    }
}
