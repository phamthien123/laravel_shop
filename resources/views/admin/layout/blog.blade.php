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
            <h1 style="text-align: center;font-size: 30px;">Table Blog</h1>
        </div>
        <a href="{{url('add_blog_exist')}}" class="btn btn-info btnAdd">Add</a>
        <table>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Link</th>
                <th></th>
                <th></th>
            </tr>
                @foreach($blog as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td><img src="/blog/{{$item->image}}" alt="blog" width="200px"></td>
                <td>{{$item->description}}</td>
                <td>{{$item->link}}</td>
                <td>
                    <a href="{{url('/edit_blog',$item->id)}}" class="btn btn-success">Edit</a>
                </td>
                <td>
                    <a onclick="return confirm('Are You Sure To Delete This Category')" href="{{url('/delete_blog',$item->id)}}" class="btn btn-primary">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </main>
    <!--   Core JS Files   -->

    @include('admin.js')

</body>

</html>