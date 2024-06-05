<div class="main">
    <div class="container">
        @if (session()->has('messages'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session()->get('messages') }}
        </div>
        @endif

   <div class="search-box">
        <form method="get" action="{{ route('searchProducts') }}">
        <div class="input-group">
       <input type="text" class="form-control" name="search" placeholder="Search for products">
                 <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div>
      </form>

      <button class="btn btn-default" id="advancedSearchToggle">Advanced Search</button>
      <div id="advancedSearchForm" style="display: none;">
        <form method="get" action="{{ route('searchProducts') }}">
          <div class="input-group">
  <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <select name="price_range" class="form-control">
                <option value="">All Prices</option>
                <option value="0-50">0 - 50 EGP</option>
                <option value="51-100">51 - 100 EGP</option>
                <option value="101-200">101 - 200 EGP</option>
            </select>
          </div>
          <div class="input-group">
            <button class="btn btn-default" type="submit">Apply Filters</button>
          </div>
        </form>

        <form method="get" action="{{ route('searchProducts') }}">
          <div class="input-group">
            <button class="btn btn-default" type="submit">Reset Search</button>
          </div>
        </form>
      </div>
    </div>


<div id="advancedSearchForm" style="display: none;">
    <form method="get" action="{{ route('searchProducts') }}">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search for products">
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <select name="price_range" class="form-control">
                <option value="">All Prices</option>
                <option value="0-50">0 - 50 EGP</option>
                <option value="51-100">51 - 100 EGP</option>
                <option value="101-200">101 - 200 EGP</option>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Search</button>
            </span>
        </div>
    </form>
            </div>
        <!-- Search Results -->
        <h2>Search Results</h2>
                      @if(isset($searchResults) && $searchResults->isNotEmpty())

        <div class="row margin-bottom-40">
            @foreach ($searchResults as $product)
            <div class="col-md-2 product-item">
                <!-- Display search results here -->
                <!-- Example: -->
                <div class="pi-img-wrapper">
                    <a href="{{ url('product_detail', $product->id) }}">
                        <img src="{{ asset('productImage/' . $product->image) }}" style="height: 288px" width="100%"
                            class="img-responsive" alt="{{ $product->title }}">
                    </a>
                    <div>
                        <a href="{{ asset('productImage/' . $product->image) }}"
                            class="btn btn-default fancybox-button">Zoom</a>
                        <a href="{{ url('product_detail', $product->id) }}"
                            class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                </div>
                <h3><a href="{{ url('product_detail', $product->id) }}">{{ $product->title }}</a></h3>
                <div class="product-price">{{ $product->price }} EGP</div>
                <div class="product-rating">
                    <div class="star-ratings">
                        @for ($i = 1; $i <= 5; $i++)
                        <!-- Replace with the rating logic for search results -->
                        <i class="fa fa-star"></i>
                        @endfor
                    </div>
                    <form method="post" action="{{ url('addcart', $product->id) }}">
                        @csrf
                        <input class="btn btn-primary" style="color: black !important" type="submit" value="Add to Cart" />
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p style="font-size:20px;text-align:center;margin-bottom: 100px;" >No Results found</p>
        <!-- End Search Results -->
        @endif

        <!-- New Arrivals -->
        <h2>New Arrivals</h2>
        <div class="row margin-bottom-40">
            @foreach ($averageRatings as $item)
            <div class="col-md-2 product-item">
                @php
                $product = $item['product'];
                $averageRatings = $item['averageRating'];
                @endphp
                <div class="pi-img-wrapper">
                    <a href="{{ url('product_detail', $product->id) }}">
                        <img src="{{ asset('productImage/' . $product->image) }}" style="height: 288px" width="100%"
                            class="img-responsive" alt="{{ $product->title }}">
                    </a>
                    <div>
                        <a href="{{ asset('productImage/' . $product->image) }}"
                            class="btn btn-default fancybox-button">Zoom</a>
                        <a href="{{ url('product_detail', $product->id) }}"
                            class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                </div>
                <h3><a href="{{ url('product_detail', $product->id) }}">{{ $product->title }}</a></h3>
                <div class="product-price">{{ $product->price }} EGP</div>
                <div class="product-rating">
                    <div class="star-ratings">
                        @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $averageRatings)
                        <i class="fa fa-star"></i>
                        @else
                        <i class="fa fa-star-o"></i>
                        @endif
                        @endfor
                    </div>
                    <form method="post" action="{{ url('addcart', $product->id) }}">
                        @csrf
                        <input class="btn btn-primary" style="color: black !important" type="submit" value="Add to Cart" />
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <!-- End New Arrivals -->


    </div>
</div>

<div class="sidebar col-md-3 col-sm-4">
    <ul class="list-group margin-bottom-25 sidebar-menu">
        @foreach ($categories as $category)
        <li class="list-group-item category-item">
            @php
            $url = url(str_replace(' ', '', $category->category_name));
            @endphp
            <a href="{{ $url }}">
                <i class="fa fa-angle-right"></i> {{ $category->category_name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>
</div>
<div class="container">
    <div class="row margin-bottom-40">
        <h2>Top Rated Products</h2>
        @foreach ($topRatedProducts as $item)
        <div class="col-md-2 product-item">
            @php
            $product = $item['product'];
            $averageRating = $item['averageRating'];
            @endphp
            <div class="pi-img-wrapper">
                <a href="{{ url('product_detail', $product->id) }}">
                    <img src="{{ asset('productImage/' . $product->image) }}" style="height: 288px" width="100%"
                        class="img-responsive" alt="{{ $product->title }}">
                </a>
                <div>
                    <a href="{{ asset('productImage/' . $product->image) }}"
                        class="btn btn-default fancybox-button">Zoom</a>
                    <a href="{{ url('product_detail', $product->id) }}"
                        class="btn btn-default fancybox-fast-view">View</a>
                </div>
            </div>
            <h3><a href="{{ url('product_detail', $product->id) }}">{{ $product->title }}</a></h3>
            <div class="product-price">{{ $product->price }} EGP</div>
            <div class="product-rating">
                <div class="star-ratings">
                    @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $averageRating)
                    <i class="fa fa-star"></i>
                    @else
                    <i class="fa fa-star-o"></i>
                    @endif
                    @endfor
                </div>
                <form method="post" action="{{ url('addcart', $product->id) }}">
                    @csrf
                    <input class="btn btn-primary" style="color: black !important" type="submit" value="Add to Cart" />
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
