<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Exception;

use App\Repositories\ProductRepository;
use App\DTOs\ProductDTO;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Services\CurrencyService;

class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }
    

    public function getProductById($id)
    {
        $currencyService = new CurrencyService();

        $product = $this->productRepository->get($id);
        $currencies = [];
        $convertedPrices = $currencyService->getConvertedPrices($product, $currencies);
        $product = new Product([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'converted_prices' => $convertedPrices,
        ]);
        return $product;
    }

    public function create(array $data) {
        $product = Product::create($data);
    
        return $product;
    }

    public function update(array $data, $id) {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    
    public function delete($id) {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}