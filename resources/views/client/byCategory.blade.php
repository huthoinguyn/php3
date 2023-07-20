<x-app-layout>
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @foreach($product_by_cate as $new)
            <x-product-card
                :name="$new->name"
                :price="$new->price"
                :image="$new->image"
                :slug="$new->product_slug"
            >
            </x-product-card>
        @endforeach

    </div><!--features_items-->
</x-app-layout>
