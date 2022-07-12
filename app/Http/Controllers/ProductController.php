<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showItem($category, $alias)
    {
        $product_item = Product::where('alias', $alias)->first();

        return view('product.show_item', [
            'item' => $product_item,
        ]);
    }

    public function showCategory(Request $request, $alias)
    {
        $category = Category::where('alias', $alias)->first();

        $products = Product::where('category_id', $category['id'])->get();

        if ($request->ajax()) {
            $dataOption = json_decode($request->dataOption);
//            return $dataOption->sortBy;
            switch ($dataOption->sortBy) {
                case "price-low-high": $products = Product::where('category_id', $category['id'])->orderBy('price')->get();
                break;
                case "price-high-low": $products = Product::where('category_id', $category['id'])->orderBy('price', 'desc')->get();
                break;
                case "name-a-z": $products = Product::where('category_id', $category['id'])->orderBy('title')->get();
                break;
                case "name-z-a": $products = Product::where('category_id', $category['id'])->orderBy('title', 'desc')->get();
                break;
            }
            return view('ajax.product_sort', [
                'products' => $products,
            ])->render();
        }

        return view('category.index', [
            'category' => $category,
            'products' => $products,
        ]);
    }

//    public function sortItems($alias, )
//    {
////        switch($data) {
////            case
////        }
//    }
}
