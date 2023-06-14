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
            <h1 style="text-align: center;font-size: 30px;">Table Product</h1>
        </div>
        <a href="{{url('view_product')}}" class="btn btn-info btnAdd">Add</a>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Feature</th>
                <th>Product_Hot</th>
                <th>Discount(%)</th>
                <th>Category_product</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($product as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->feature}}</td>
                <td>{{$item->product_hot}}</td>
                <td>{{$item->discount_price}}</td>
                <td>{{$item->category_name}}</td>
                <td><img src="/product/{{$item->image}}" alt="product" width="100px"></td>
                <td>
                    <a href="{{url('/edit_product',$item->pid)}}" class="btn btn-success">Edit</a>
                </td>
                <td>
                    <a onclick="return confirm('Are You Sure To Delete This Category')" href="{{url('/delete_product',$item->pid)}}" class="btn btn-primary">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </main>
    <!--   Core JS Files   -->
    @include('admin.js')
   <div>
   {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}     
   </div>
</body>

</html>