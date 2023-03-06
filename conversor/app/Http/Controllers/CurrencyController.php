<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

//use App\Repositories\CurrencyRepository;



class CurrencyController {

    public function all() {
        $response = Http::get(env('BASE_URL') . '/all');
        $currencies = json_decode($response->body());
        return new JsonResponse($currencies);
    }

    public function get($symbol){
        $response = Http::get(env('BASE_URL') . '/' . $symbol);
        //dd($response);
        $currency = json_decode($response->body());
        return new JsonResponse($currency);
    }
    
    public function convert($value, $symbol){
        $currency = $this->get($symbol);
        $convertedValue = $value * $currency->ask;
        return new JsonResponse(['convertedValue' => $convertedValue]);
    }
}
