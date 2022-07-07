<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showItem($category, $id) {
        $product_item = Product::where('id', $id)->first();

        return view('product.show_item',[
            'item' => $product_item,
        ]);
    }

    public function
}
