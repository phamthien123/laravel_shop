<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.head')
</head>

<body>
    <!--================Header Menu Area =================-->
    @include('home.header')
    <!--================Header Menu Area =================-->

    <!--================ Feature Product Area =================-->
    <section class="inspired_product_area section_gap_bottom_custom">
        <div class="container">
            <div class="row">
                @foreach($productSearch as $productAll)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <div class="product-img">
                            <img class="img-fluid w-100" src="{{asset('product/'.$productAll->image)}}" alt="" />
                            <div class="p_icon">
                                <form action="{{url('add_cart',$productAll->id)}}" method="post">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1">
                                    <input type="submit" value="Add To Cart">
                                </form>
                            </div>
                        </div>
                        <div class="product-btm">
                            <a href="{{url('product_detail',$productAll->id)}}" class="d-block">
                                <h4>{{$productAll->title}}</h4>
                            </a>
                            <div class="mt-3">
                                <span class="mr-4">{{number_format($productAll->price)}}VNĐ</span>
                                <del>{{$productAll->discount_price}}%</del>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <span>
                {!!$productSearch->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
        </div>
    </section>
    <!--================ End Feature Product Area =================-->

    <!--================ start footer Area  =================-->
    @include('home.footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(function() {
            $("#clickElement").click(function(e) {
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
                if (e.which == 13 && search == "") { //Enter key pressed
                    $('#clickElement').off('click.mynamespace');
                    return false;
                }
            });
        });
    </script>
    @include('home.js')
</body>

</html>