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
        @if(session()->has('message'))
        <div class="alert alert-success" id="textAlert">
            {{session()->get('message')}}
        </div>
        @endif
        <div class="container-fluid py-4">
            <h1 style="text-align: center;font-size: 30px;">Table User</h1>
        </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Usertype</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            @foreach($user as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->usertype}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->address}}</td>
                <td>
                    <a onclick="return confirm('Are You Sure To Delete This User')" href="{{url('/delete_user',$item->id)}}" class="btn btn-primary">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </main>
    <!--   Core JS Files   -->

    @include('admin.js')

</body>

</html>