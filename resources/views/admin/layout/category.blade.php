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
            width: 70%;
            margin: auto;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
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
            <h1 style="text-align: center;font-size: 30px;">Add Category</h1>
        </div>
        <form class="form-inline" action="{{url('/add_category')}}" method="post">
            @csrf
            <input type="text" name="category" placeholder="Write Category" class="add">
            <input type="submit" name="submit" class="btn btn-primary button" value="Add">
        </form>
        <table>
            <tr>
                <th>CategoryName</th>
                <th>Action</th>
            </tr>
            @foreach($data as $item)
            <tr>
                <td>{{$item->category_name}}</td>
                <td>
                    <a onclick="return confirm('Are You Sure To Delete This Category')" href="{{url('/delete_category',$item->id)}}" class="btn btn-primary">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </main>
    <!--   Core JS Files   -->

    @include('admin.js')

</body>

</html>