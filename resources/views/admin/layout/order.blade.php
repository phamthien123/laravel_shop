<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
    <style>
        .form-inline {
            margin-left: 30%;
        }

        .add {
            width: 50%;
            color: #000;
        }

        .button {
            margin-top: 10px;
            background-color: green !important;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
            margin: auto;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        .btnAdd {
            margin-left: 85%;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('admin.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('admin.navbar')
        <!-- End Navbar -->
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
            @foreach($order as $item)
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
                @else
                <td>
                    <p class="text-info">Delivery</p>
                </td>
                @endif
                @if($item->delivery_status == 'Delivery')
                <td><a onclick="return confirm('Are You Sure To This Received')" href="{{url('received',$item->id)}}" class="btn btn-success">Received</a></td>
                @elseif($item->delivery_status == 'Received')
                @else
                <td><a  href="#" class="btn btn-success" style=" pointer-events: none; color: #ccc;">Received</a></td>
                @endif
                @if($item->received_status == 'Received')
                <td>
                    <p class="text-danger">Item received</p>
                </td>
                @endif
            </tr>
            @endforeach
        </table>
    </main>
    <!--   Core JS Files   -->
    @include('admin.js')
    <div>
        {!!$order->withQueryString()->links('pagination::bootstrap-5')!!}
    </div>
</body>

</html>