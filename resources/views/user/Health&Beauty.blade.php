<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.css')
    <!-- Include your CSS here -->
</head>
<body class="ecommerce">
    @include('user.header')
    <div class="main">
        <div class="container">
            @if (session()->has('messages'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session()->get('messages') }}
                </div>
            @endif
            @include('user.categories')
            <!-- BEGIN CONTENT -->
            <h2>Health & Beauty</h2>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4 col-sm-6 product-item"">
                        <div class="pi-img-wrapper">
                            <a href="{{ url('product_detail', $product->id) }}">
                        <img src="{{ asset('productImage/' . $product->image) }}" style="height: 288px" width="100%"
                                    class="img-responsive" alt="{{ $product->title }}">
                            </a>
                            <div>
                                <a href="{{ asset('productImage/' . $product->image) }}"
                                    class="btn btn-default fancybox-button"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ url('product_detail', $product->id) }}"
                                    class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        <h3><a href="{{ url('product_detail', $product->id) }}">{{ $product->title }}</a></h3>
                        <div class="pi-price">{{ $product->price }} EGP</div>
                        <form method="post" action="{{ url('addcart', $product->id) }}">
                            @csrf
                            <input class="btn btn-primary" type="submit" value="Add to Cart" />
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
    @include('user.footer')
    @include('user.js')
</body>
</html>
