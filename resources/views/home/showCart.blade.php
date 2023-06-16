<!DOCTYPE html>
<html lang="en">

<head>

</head>
@include('home.head')

<body>
    <!--================Header Menu Area =================-->
    @include('home.header')
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Cart</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="cart.html">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    @if(session()->has('message'))
    <div class="alert alert-success" id="textAlert">
        {{session()->get('message')}}
    </div>
    @endif
    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr style="margin-left:10px">
                                <th scope="col">Product - Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $Total = 0; ?>
                            @foreach($cart as $item)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/single-product/cart-1.jpg" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <p>{{$item->product_title}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5><img src="{{asset('product/'.$item->image)}}" alt="" width="100px"></h5>
                                </td>
                                <td>
                                    <p>{{$item->quantity}}</p>
                                </td>
                                <td>
                                    <h5>{{number_format($item->price)}} VNĐ</h5>
                                </td>
                                <td>
                                    <h5><a onclick="return confirm('Are You Sure To Delete This Cart')" href="{{url('remove_cart',$item->id)}}" class="btn btn-danger">X</a></h5>
                                </td>
                            </tr>
                            <?php $Total = $Total + $item->price ?>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5>{{number_format($Total)}} VNĐ</h5>
                                </td>
                                <td></td>
                            </tr>

                            <tr class="out_button_area">
                                <td>  <a class="gray_btn" href="{{url('/index')}}">Continue Shopping</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner">
                                        <a class="main_btn" href="{{url('stripe',$Total)}}">Proceed To Payment</a>
                                        <a class="main_btn" href="{{url('checkout')}}">Proceed to checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

    <!--================ start footer Area  =================-->
    @include('home.footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('home.js')
</body>

</html>