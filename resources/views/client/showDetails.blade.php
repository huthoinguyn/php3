<x-app-layout>
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="/storage/{{ $product_details->image }}" alt=""/>
                <h3>ZOOM</h3>
            </div>
        </div>

        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="{{asset('client/images/product-details/new.jpg')}}" class="newarrival" alt=""/>
                <h2>{{ $product_details->name }}</h2>
                <p>Web ID: 1089772</p>
                <img src="{{asset('client/images/product-details/rating.png')}}" alt=""/>
                <span>
									<span>US ${{ $product_details->price }}</span>
									<label>Quantity:</label>
									<input type="text" value="3"/>
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Condition:</b> New</p>
                <p><b>Brand:</b> {{ $product_details->brand_name }} </p>
                <a href=""><img src="{{asset('client/images/product-details/share.png')}}"
                                class="share img-responsive"
                                alt=""/></a>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->
</x-app-layout>
