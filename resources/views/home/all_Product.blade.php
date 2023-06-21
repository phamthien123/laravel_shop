<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.head')
</head>

<body>
    @include('sweetalert::alert')
    <!--================Header Menu Area =================-->
    @include('home.header')
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Shop Category</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="category.html">Shop</a>
                        <a href="category.html">Women Fashion</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-12">
                    <div class="slider-area">
                        @include('slider')
                    </div>
                    <div class="search-result">
                        @include('home.search_result')
                    </div>
                </div>
            </div>
    </section>
    <!--================End Category Product Area =================-->

    <!--================ start footer Area  =================-->
    @include('home.footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function(e) {
            $('#sort_by').on('change', function() {
                let sort_by = $('#sort_by').val();
                $.ajax({
                    url: "{{ url('sort-by') }}",
                    method: "GET",
                    data: {
                        sort_by: sort_by
                    },
                    success: function(res) {
                        $('.search-result').html(res);
                    }

                });
            });
        })
    </script>
    @include('home.js')
</body>

</html>