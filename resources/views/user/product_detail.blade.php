<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.css')
</head>
<body class="ecommerce">
    @include('user.header')

    <div class="content-wrapper">
        <div class="content-header">
            <h1>{{ $product->title }}</h1>
        </div>

        <div class="content">
            <div class="product-detail">
                <div class="product-image">
                    <img src="{{ asset('productImage/' . $product->image) }}" alt="{{ $product->title }}">
                </div>
                <div class="product-info">
                    <h2>{{ $product->title }}</h2>
                    <p class="price">Price: {{ $product->price }} EGP</p>
                    <div class="average-rating">
                        Average Rating: 
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($averageRating >= $i)
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                    </div>
                    <p class="description">{{ $product->description }}</p>
                    <form method="post" action="{{ route('add_to_cart', ['id' => $product->id])}}">
                        @csrf
                        <div class="quantity">
                            <label for="quantity">Select Quantity:</label>
                            <select name="quantity" id="quantity">
                                @for ($i = 1; $i <= 15; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button class="btn btn-primary add-to-cart" type="submit">Add to Cart</button>
                    </form>
                </div>
                @auth
                <form method="post" action="{{ route('submit_rating', ['id' => $product->id])}}">
                    @csrf
                    <div class="rating">
                        <label for="rating">Rate this product:</label>
                        <select name="rating" id="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <button class="btn btn-primary submit-rating" type="submit">Submit Rating</button>
                </form>
                    @endauth

            </div>
        </div>
    </div>

    @include('user.footer');
    @include('user.js');
</body>
</html>
