<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\DTOs\ProductDTO;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Http\Controllers\CurrencyController;

class ProductController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function all()
    {
        $products = $this->productService->all();
        return response()->json($products);
    }

    public function create(Request $request)
    {
        $product = $this->productService->create($request->all());
        return response()->json(["id" => $product->id]);
    }

    public function get($id) {
        $product = $this->productService->getProductById($id);
        $convertedPrices = $this->productService->getConvertedPrices($product, $id);
    
        $product = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'converted_prices' => $convertedPrices
        ];
        return response()->json($product);
    }

    public function delete($id)
    {
        $this->productService->delete($id);
        return response()->json(["message" => "Produto deletado com sucesso"]);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->update($request->all(), $id);
        return response()->json(["id" => $product->id]);
    }
    public function getProduct($id) {
        $productRepository = new ProductRepository();
        // Obtenha as informações do produto
        $product = $productRepository->get($id);
    
        // Crie um objeto CurrencyController
        $currencyController = new CurrencyController();
    
        // Converta o valor do produto para USD e EUR
        $valueInUSD = $currencyController->convertToUSD($product->value, $product->currency);
        $valueInEUR = $currencyController->convertToEUR($product->value, $product->currency);
    
        // Crie um objeto ProductDTO com as informações do produto e suas conversões de moeda
        $productDTO = new ProductDTO($product->name, $product->value, $valueInUSD, $valueInEUR);
    
        // Retorne o objeto ProductDTO como JSON
        return response()->json($productDTO);
    }
}