<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller{

    /**
     * @param Product $product
     *
     * @return View
     */
    public function showDetails(Product $product)
    : View{
        $product_details = Product::query()
                                  ->join('categories', 'categories.id', '=', 'products.category_id')
                                  ->join('brands', 'brands.id', '=', 'products.brand_id')
                                  ->where('products.status', '=', 1)
                                  ->where('products.slug', '=', $product->slug)
                                  ->select('products.name as name', 'products.price as price',
                                      'products.image as image', 'categories.name as category_name',
                                      'brands.name as brand_name')
                                  ->first();

        return view('client.showDetails', compact('product_details'));
    }
}
