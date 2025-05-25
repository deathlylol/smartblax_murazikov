<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected ProductService $productService;
    protected ProductRepositoryInterface $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepository = Mockery::mock(ProductRepositoryInterface::class);
        $this->productService = new ProductService($this->productRepository);
    }

    #[Test]
    public function it_can_create_new_product()
    {
        $category = Category::factory()->create();
        $productData = [
            'name' => 'Test Product',
            'price' => 100.50,
            'barcode' => '123456789',
            'category_id' => $category->id
        ];

        $expectedProduct = new Product($productData);

        $this->productRepository
            ->shouldReceive('create')
            ->once()
            ->with($productData)
            ->andReturn($expectedProduct);

        $result = $this->productService->create($productData);
        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($productData['name'], $result->name);
        $this->assertEquals($productData['price'], $result->price);
        $this->assertEquals($productData['barcode'], $result->barcode);
        $this->assertEquals($productData['category_id'], $result->category_id);
    }

    #[Test]
    public function it_can_update_product_price()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100.50,
            'barcode' => '123456789',
            'category_id' => $category->id
        ]);

        $newPrice = 150.75;
        $updateData = ['price' => $newPrice];

        $this->productRepository
            ->shouldReceive('update')
            ->once()
            ->with($product, $updateData)
            ->andReturn($product->fill($updateData));

        $result = $this->productService->update($product, $updateData);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($newPrice, $result->price);
        $this->assertEquals($product->name, $result->name);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
