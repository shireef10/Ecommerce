<!-- BEGIN TOP BAR -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right" style="    font-size: 17px;    font-weight: bold;">
                    @guest
                    <li><a href="{{ route('login') }}">Log In</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                    @else
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END TOP BAR -->

<!-- Header -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="/" style="width: 328px;"><img src=".././assets/limitless_logo.png"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN CART -->
        @if (Auth::check())
            <a href="{{ route('showcart') }}" class="top-cart-block" style="margin-top:60px;">
                <div class="top-cart-info" style="    font-weight: bold;">
                    <span class="top-cart-info-count">{{ $count }} items</span>
                    <span class="top-cart-info-value">{{$total}} EGP</span>
                </div>
                <i class="fa fa-shopping-cart"></i>
            </a>
        @endif
        <!--END CART -->

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation" style="text-align: center; margin-top:30px;    font-weight: bold;">
            <ul>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="/" href="/">
                        Home 
                    </a>
                </li>
                <li class="dropdown dropdown-megamenu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li>
<div class="header-navigation-content">
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 header-navigation-col">
            <h4>{{ $category->category_name }}</h4>
            <ul>
                <li>
                    <a href="{{ url(str_replace(' ', '', $category->category_name)) }}">{{ $category->category_name }}</a>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</div>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>
<!-- Header END -->
