<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Http\Controllers\CurrencyController;
use App\Services\CurrencyService;

class ProductController
{

    private $productService;
    protected $currencyService;

    public function __construct(ProductService $productService, CurrencyService $currencyService)
    {
        $this->productService = $productService;
        $this->currencyService = $currencyService;
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
        $currencies = ['USD','CAD','GBP','ARS','BTC','LTC','EUR','JPY','CHF','AUD','CNY','ILS','ETH','XRP','DOGE'];
        $convertedPrices = $this->currencyService->getConvertedPrices($product, $currencies);
    
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
}