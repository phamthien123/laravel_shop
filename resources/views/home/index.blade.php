<!DOCTYPE html>
<html lang="en">

<head>
@include('home.head')
</head>

<body>
    <!--================Header Menu Area =================-->
    @include('home.header')
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    @include('home.slider')
    <!--================End Home Banner Area =================-->

    <!--================ Feature Product Area =================-->
    @include('home.product-feature')
    <!--================ End Feature Product Area =================-->

    <!--================ Offer Area =================-->
    @include('home.area')
    <!--================ End Offer Area =================-->

    <!--================ New Product Area =================-->
    @include('home.product-new')
    <!--================ End New Product Area =================-->

    <!--================ Inspired Product Area =================-->
    @include('home.product-area')
    <!--================ End Inspired Product Area =================-->
   
    <!--================ Start Blog Area =================-->
    @include('home.blog')
    <!--================ End Blog Area =================-->

    <!--================ start footer Area  =================-->
    @include('home.footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('home.js')
</body>

</html>