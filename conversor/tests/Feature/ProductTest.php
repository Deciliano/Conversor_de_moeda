<?php

namespace Tests\Feature;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testGetProduct()
    {
        // Crie um produto de teste
        $productData = [
            'name' => 'Test Product',
            'price' => 10.00,
            'description' => 'Test Description',
        ];
        $productRepo = new ProductRepository();
        $product = $productRepo->create($productData);

        // Chame o método get() do ProductRepository com o ID do produto de teste
        $retrievedProduct = $productRepo->get($product->id);

        // Verifique se o produto retornado é o mesmo que o produto de teste
        $this->assertEquals($product->id, $retrievedProduct->id);
        $this->assertEquals($product->name, $retrievedProduct->name);
        $this->assertEquals($product->price, $retrievedProduct->price);
        $this->assertEquals($product->description, $retrievedProduct->description);
    }
    
}
