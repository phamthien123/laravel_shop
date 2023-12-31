<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="float-left">
                        <p>Phone: +01 256 25 235</p>
                        <p>email: thien@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="float-right">
                        <ul class="right_side">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.html">
                    <img src="{{asset('home/img/logo.png')}}" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url('/')}}">Home</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('all_Product')}}">Product All</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('orderCart')}}">Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('showCart')}}">Shopping Cart</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="blog.html">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="single-blog.html">Blog Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item" style="margin-top: 20px;">
                                    <form action="{{url('Search_product')}}" method="get" id="formSearch">
                                        <div class="input-group">
                                            @csrf
                                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" value="{{request()->input('search')}}" id="search_product" />
                                            <button type="button" class="btn btn-outline-primary" id="clickElement">search</button>
                                        </div>
                                    </form>

                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                @if (Route::has('login'))
                                @auth
                                <li class="nav-item">
                                    <x-app-layout>

                                    </x-app-layout>
                                </li>
                                @else
                                <li>
                                    <a class="btn btn-primary" href="{{ route('login') }}" style="margin-top: 20px;">
                                        Login
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-success" href="{{ route('register') }}" style="margin-top: 20px;">
                                        Register
                                    </a>
                                </li>
                                @endauth
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>