@extends('index')

@section('content')
<div class="container">
    @if(count($products) > 0)
        <div class="row">
            @foreach($products as $product)
            <div class="col-sm-3 mt-4">
                <div class="single-item border rounded p-3 shadow-lg bg-white">
                    <div class="single-item-header text-center">
                        <a href="detail/{{$product->id}}">
                            <img width="220" height="220" src="source/image/product/{{$product->image}}" 
                                 alt="{{$product->name}}" class="rounded">
                        </a>
                    </div>
                    <div class="single-item-body text-center">
                        <p class="single-item-title fw-bold text-primary">{{$product->name}}</p>
                        <p class="single-item-price fs-5">
                            @if($product->promotion_price == 0)
                                <span class="flash-sale text-danger fw-bold">
                                    {{ number_format($product->unit_price) }} Đồng
                                </span>
                            @else
                                <span class="flash-del text-muted text-decoration-line-through">
                                    {{ number_format($product->unit_price) }} Đồng
                                </span>
                                <span class="flash-sale text-danger fw-bold">
                                    {{ number_format($product->promotion_price) }} Đồng
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="single-item-caption text-center mt-3">
                        <a class="add-to-cart btn btn-outline-primary me-2" href="{{ route('themgiohang', $product->id) }}">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <a class="add-to-cart btn btn-outline-danger me-2" href="#">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a class="beta-btn btn btn-primary" href="{{ route('chitiet_sanpham', ['id' => $product->id]) }}">
                            Details <i class="fa fa-chevron-right"></i>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="d-flex flex-column align-items-center justify-content-center mt-5 p-5 border rounded shadow-lg bg-light" 
             style="width: 80%; margin: auto; height: 400px;">
            <img src="{{ asset('source/image/no-product.png') }}" alt="Không có sản phẩm" width="200" class="mb-3">
            <h2 class="text-danger fw-bold">Không tìm thấy sản phẩm nào!</h2>
            <p class="text-muted fs-5">Vui lòng thử lại với từ khóa khác.</p>
            <a href="{{ route('index') }}" class="btn btn-lg btn-primary mt-3">
                <i class="fa fa-home"></i> Quay lại trang chủ
            </a>
        </div>
    @endif
</div>
@endsection
