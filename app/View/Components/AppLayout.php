<?php

namespace App\View\Components;

use App\Models\Brand;
use App\Models\Category;
use App\Models\TextWidget;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component{

    /**
     * Get the view / contents that represents the component.
     */
    public function render()
    : View{
        $categories = Category::withCount('products')
                              ->where('status', '=', 1)
                              ->where('type', '=', 'sanpham')
                              ->orderByDesc('id')
                              ->get();
        $brands     = Brand::query()
                           ->where('status', '=', 1)
                           ->orderByDesc('id')
                           ->get();
        $widget     = TextWidget::all();

        return view('layouts.app', compact('categories', 'brands', 'widget'));
    }
}
