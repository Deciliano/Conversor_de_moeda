<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Exception;

use App\Repositories\ProductRepository;
use App\DTOs\ProductDTO;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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
        $product = $this->productRepository->get($id);
        $currencies = null; // Remover a chamada para getCurrencies()
        $convertedPrices = $this->getConvertedPrices($product, $currencies); // Usar getConvertedPrices() em seu lugar
        $product = new Product([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'converted_prices' => $convertedPrices,
        ]);
        return $product;
    }
    
    private function findCurrencyInfo($currencyData, $currency) {
        foreach ($currencyData as $currencyInfo) {
            if ($currencyInfo->code === $currency) {
                return $currencyInfo;
            }
        }
      
        return null;
    }
              
    public function getConvertedPrices(Product $product, $currencies) {
        $response = Http::get(env('BASE_URL') . '/all');
        $currencies = json_decode($response->body());
    
        $convertedPrices = [];
        foreach ($currencies as $currency) {
            if ($currency->code !== $product->price_currency) {
                $convertedPrice = $product->price / $currency->ask;
                $convertedPrices[$currency->code] = number_format($convertedPrice, 2, '.', '');
            }
        }
    
        return $convertedPrices;
        
    }
   

    public function update(array $data, $id) {
        // Obtenha o produto pelo id
        $product = Product::findOrFail($id);
    
        // Atualize as informações do produto com os dados fornecidos
        $product->update($data);
    
        // Retorne o produto atualizado
        return $product;
    }

    public function create(array $data) {
        $product = Product::create($data);
    
        return $product;
    }
    
    public function delete($id) {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}