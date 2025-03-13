@extends('index')
@section('content')

<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{ $product_detail->name }}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                {{-- <a href="{{ route('index') }}">Home</a> / <span>{{ $product_detail->name }}</span> --}}

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-4">
                        <img src="{{ asset('/image/product/' . $product_detail->image) }}" alt="{{ $product_detail->name }}">
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-title">{{ $product_detail->name }}</p>
                            <p class="single-item-price">
                                <span>${{ number_format($product_detail->price, 2) }}</span>
                            </p>
                        </div>

                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>

                        <div class="single-item-desc">
                            <p>{{ $product_detail->description }}</p>
                        </div>
                        <div class="space20">&nbsp;</div>

                        <p>Options:</p>
                        <div class="single-item-options">
                            <select class="wc-select" name="size">
                                <option>Size</option>
                                <option value="XS">XS</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                            <select class="wc-select" name="color">
                                <option>Color</option>
                                <option value="Red">Red</option>
                                <option value="Green">Green</option>
                                <option value="Yellow">Yellow</option>
                                <option value="Black">Black</option>
                                <option value="White">White</option>
                            </select>
                            <select class="wc-select" name="quantity">
                                <option>Qty</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="space40">&nbsp;</div>
                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#tab-description">Description</a></li>
                        {{-- <li><a href="#tab-reviews">Reviews ({{ $product_detail->reviews->count() }})</a></li> --}}
                    </ul>

                    <div class="panel" id="tab-description">
                        <p>{{ $product_detail->long_description }}</p>
                    </div>
                    <div class="panel" id="tab-reviews">
                        {{-- @if ($product_detail->reviews->count() > 0)
                            @foreach ($product_detail->reviews as $review)
                                <p>{{ $review->content }} - <strong>{{ $review->user->name }}</strong></p>
                            @endforeach
                        @else
                            <p>No Reviews</p>
                        @endif --}}
                    </div>
                </div>

                <div class="space50">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>Related Products</h4>

                    {{-- <div class="row">
                        @foreach($related_products as $related)
                        <div class="col-sm-4">
                            <div class="single-item">
                                <div class="single-item-header">
                                    <a href="{{ route('product.detail', $related->id) }}"><img src="{{ asset('source/assets/dest/image/product/' . $related->image) }}" alt=""></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{ $related->name }}</p>
                                    <p class="single-item-price">
                                        <span>${{ number_format($related->price, 2) }}</span>
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="{{ route('product.detail', $related->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{ route('product.detail', $related->id) }}">Details <i class="fa fa-chevron-right"></i></a>
                                    <a class="beta-btn primary" href="{{ route('chitiet_sanpham', ['id' => $product_detail->id]) }}">
                                        Details <i class="fa fa-chevron-right"></i>
                                    </a>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> --}}
                </div> 
            </div>
            <div class="col-sm-3 aside">
                <div class="widget">
                    <h3 class="widget-title">Best Sellers</h3>
                    <div class="widget-body">
                        {{-- <div class="beta-sales beta-lists">
                            @foreach($best_sellers as $best)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{ route('product.detail', $best->id) }}"><img src="{{ asset('source/assets/dest/image/product/' . $best->image) }}" alt=""></a>
                                <div class="media-body">
                                    {{ $best->name }}
                                    <span class="beta-sales-price">${{ number_format($best->price, 2) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div> --}}
                    </div>
                </div> 
{{-- 
                <div class="widget">
                    <h3 class="widget-title">New Products</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach($new_product as $new)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{ route('product.detail', $new->id) }}"><img src="{{ asset('source/assets/dest/image/product/' . $new->image) }}" alt=""></a>
                                <div class="media-body">
                                    {{ $new->name }}
                                    <span class="beta-sales-price">${{ number_format($new->price, 2) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>  --}}
            </div>
        </div>
    </div> 
</div> 
@endsection
