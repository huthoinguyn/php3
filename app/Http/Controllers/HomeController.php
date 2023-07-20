<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller{

    public function index(){
        $featured_products = Product::query()
                                    ->where('status', '=', 1)
                                    ->where('featured', '=', 1)
                                    ->orderByDesc('id')
                                    ->limit(3)
                                    ->get();
        //        $new_products = Product::query()
        //            ->where('status', '=', 1)
        //            ->orderByDesc('id')
        //            ->limit(3)
        //            ->get();
        return view('client.home', ['featured_products' => $featured_products]);
    }

    /**
     * @param Category $category
     *
     * @return View
     */
    public function byCategory(Category $category)
    : View{
        $product_by_cate = Product::query()
                                  ->join('categories', 'products.category_id', '=', 'categories.id')
                                  ->select('categories.slug as category_slug',
                                      'products.name as name', 'products.price as price',
                                      'products.image as image', 'products.slug as product_slug')
                                  ->where('categories.slug', '=', $category->slug)
                                  ->where('products.status', '=', 1)
                                  ->get();

        return view('client.byCategory', compact('product_by_cate'));
    }
}
