<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
    <style>
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
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
            <h1 style="text-align: center;font-size: 30px;">Add Product</h1>
            <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="Title">Title</label>
                <input type="text" id="title" name="title" placeholder="Write Title" required="">

                <label for="Description">Description</label>
                <input type="text" id="description" name="description" placeholder="Write Description" required="">

                <label for="Category">Category</label>
                <select id="category" name="category" required="">
                    <option value="">Add Category</option>
                    @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                    @endforeach
                </select>

                <label for="Quantity">Quantity</label>
                <input type="text" id="quantity" name="quantity" placeholder="Write Quantity" required="">

                <label for="Quantity">Price</label>
                <input type="text" id="price" name="price" placeholder="Write Price" required="">

                <label for="feature">Feature</label>
                <select id="feature" name="feature" required="">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>

                <label for="product_Hot">Product Hot</label>
                <select id="product_Hot" name="product_Hot" required="">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>

                <label for="Quantity">Discount</label>
                <input type="text" id="discount" name="discount" placeholder="Write Discount" required="">

                <label for="Image">Image</label>
                <input type="file" id="image" name="image">

                <input type="submit" value="Add Product">
            </form>
        </div>
    </main>
    <!--   Core JS Files   -->
    @include('admin.js')
</body>

</html>