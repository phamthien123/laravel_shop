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
                        <h2>Order</h2>
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
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th></th>
                                <th scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $Total = 0; ?>
                            @foreach($order as $item)
                            <tr>
                                <td>
                                    <img src="{{asset('product/'.$item->image)}}" alt="" width="200px">
                                </td>
                                <td>
                                    {{$item->product_title}}
                                </td>
                                <td>
                                    {{number_format($item->price)}} VNĐ
                                </td>
                                <td></td>
                                @if($item->delivery_status == 'Processing')
                                <td>
                                    <h5>{{$item->delivery_status}}</h5>
                                </td>
                                @elseif($item->delivery_status == 'Delivery')
                                <td>
                                    <h5>{{$item->delivery_status}}</h5>
                                </td>
                                @elseif($item->delivery_status == 'Your Cancel The Order')
                                <td>
                                    <h5>{{$item->delivery_status}}</h5>
                                </td>
                                @else
                                <td>
                                    <h5>{{$item->delivery_status}}</h5>
                                </td>
                                @endif
                                @if($item->delivery_status == 'Delivery' || $item->delivery_status == 'Received' ||  $item->delivery_status == 'Your Cancel The Order' )
                                <td><a href="#" class="btn btn-danger" style="pointer-events: none; color: #ccc;">Cancel Order</a> </td>
                                @else
                                <td><a onclick="return confirm('Are You Sure Cancel')" href="{{url('cancel',$item->id)}}" class="btn btn-danger">Cancel Order</a> </td>
                                @endif
                            </tr>
                            <?php $Total = $Total + $item->price ?>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>Subtotal</td>
                                <td>
                                    <h5>{{number_format($Total)}} VNĐ</h5>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr class="out_button_area">
                                <td> </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner">
                                        <a class="gray_btn" href="#">Repurchase</a>
                                        <a class="gray_btn" href="#">Order Detail</a>
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