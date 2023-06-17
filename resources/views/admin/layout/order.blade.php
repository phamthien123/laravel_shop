<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('admin.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('admin.navbar')
        <!-- End Navbar -->
        <div class="wrap">
            <div class="search">
                <form action="{{url('searchOrder')}}" method="get" id="formSearch">
                    @csrf
                    <input type="text" name="searchOrder" id="search_order" placeholder="Search Order" value="{{request()->input('searchOrder')}}">
                </form>
                <button id="clickElement" class="btn btn-info">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success" id="textAlert">
            {{session()->get('message')}}
        </div>
        @endif
        <div class="container-fluid py-4">
            <h1 style="text-align: center;font-size: 30px;">Table Order</h1>
        </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Product_title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Payment_status</th>
                <th>Status</th>
                <th>Received</th>
            </tr>
            @forElse($order as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->product_title}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
                <td><img src="/product/{{$item->image}}" alt="product" width="100px"></td>
                <td>{{$item->payment_status}}</td>

                @if($item->delivery_status == 'Processing')
                <td><a onclick="return confirm('Are You Sure To This Order')" href="{{url('delivery',$item->id)}}" class="btn btn-info">Processing</a></td>
                @elseif($item->delivery_status == 'Your Cancel The Order')
                <td>
                    <p class="text-danger">Order Cancel</p>
                </td>
                @else
                <td>
                    <p class="text-info">Delivery</p>
                </td>
                @endif
                @if($item->delivery_status == 'Delivery')
                <td><a onclick="return confirm('Are You Sure To This Received')" href="{{url('received',$item->id)}}" class="btn btn-success">Received</a></td>
                @elseif($item->delivery_status == 'Received')
                @else
                <td><a href="#" class="btn btn-success" style=" pointer-events: none; color: #ccc;">Received</a></td>
                @endif
                @if($item->received_status == 'Received')
                <td>
                    <p class="text-success">Item received</p>
                </td>
                @endif
            </tr>
            @empty

            <h3 style="text-align: center;" class="text-danger">Not Item Found</h3>
            @endforElse
        </table>
    </main>
    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(function() {
            $("#clickElement").click(function() {
                let search = document.getElementById("search_order").value;
                if (search != "") {
                    $('#clickElement').unbind('click.mynamespace');
                    $("#formSearch").submit();
                } else {
                    $('#clickElement').off('click.mynamespace');
                }
            });

            $('#search_order').keypress(function(e) {
                let search = document.getElementById("search_order").value;
                console.log(search);
                if (e.which == 13 && search == "") { //Enter key pressed
                    $('#clickElement').off('click.mynamespace');
                    return false;
                }
            });
        });
    </script>


    @include('admin.js')
    <!-- <div>

    </div> -->
</body>

</html>