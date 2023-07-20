<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img src="/storage/{{ $image }}" alt=""/>
                <h2>{{ $price }}vnđ</h2>
                <p>{{ $name }}</p>
                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
            </div>
            <div class="product-overlay">
                <div class="overlay-content">
                    <h2>{{ $price }}vnđ</h2>
                    <p>{{ $name }}</p>
                    <a href="{{ route('show-details', $slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
            </ul>
        </div>
    </div>
</div>
