<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCardComponent extends Component{

    public $slug;
    public $name;
    public $price;
    public $image;

    /**
     * Create a new component instance.
     */
    public function __construct($slug, $name, $price, $image){
        $this->slug  = $slug;
        $this->name  = $name;
        $this->price = $price;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    : View|Closure|string{
        return view('components.product-card');
    }
}
