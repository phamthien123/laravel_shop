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
                <form action="{{url('searchProduct')}}" method="get" id="formSearch">
                    @csrf
                    <input type="text" name="searchProduct" id="search_product" placeholder="Search Product" value="{{request()->input('searchProduct')}}">
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
            @forElse($product as $item)
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
            
            @empty
            <h3 style="text-align: center;" class="text-danger">Not Item Found</h3>
            @endforElse
        </table>
        {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
    </main>
    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(function() {
            $("#clickElement").click(function() {
                let search = document.getElementById("search_product").value;
                if (search != "") {
                    $('#clickElement').unbind('click.mynamespace');
                    $("#formSearch").submit();
                } else {
                    $('#clickElement').off('click.mynamespace');
                }
            });

            $('#search_product').keypress(function(e) {
                let search = document.getElementById("search_product").value;
                console.log(search);
                if (e.which == 13 && search == "") { //Enter key pressed
                    $('#clickElement').off('click.mynamespace');
                    return false;
                }
            });
        });
    </script>
    @include('admin.js')
</body>

</html>