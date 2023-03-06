<?php

namespace App\Repositories;

use App\Http\Controllers\ProductController;
use App\Models\Product;

class ProductRepository {

    public function all(){
        $products = Product::All();
        return $products;
    }

    public function create(array $data){
        $product = new Product($data);
        $product->save();
        return $product;
    }

    public function get($id){
        $product = Product::Find($id);
        return $product;
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function update(array $data, $id){
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
}