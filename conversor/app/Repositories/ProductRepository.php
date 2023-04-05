<?php

namespace App\Repositories;

use App\Http\Controllers\ProductController;
use App\Models\Product;

class ProductRepository {

    public function all(){
        $products = Product::All();
        return $products;
    }

    public function get($id){
        $product = Product::Find($id);
        return $product;
    }
}