<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

use App\Repositories\ProductRepository;
use App\Service\ProductService;
use App\Models\Product;
use App\Http\Controllers\CurrencyController;

class CurrencyService
{
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

    public function currencie(){ 
        $currencies = [
        'USD','CAD','GBP','ARS','BTC','LTC','EUR','JPY','CHF','AUD','CNY','ILS','ETH','XRP','DOGE'
        ];
    }
}