<section class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Hot product</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($pro_hot as $hot)
            <div class="col-lg-4 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{asset('product/'.$hot->image)}}" alt="" />
                        <div class="p_icon">
                            <a href="#">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="#">
                                <i class="ti-heart"></i>
                            </a>
                            <a href="#">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="#" class="d-block">
                            <h4>Latest men’s sneaker</h4>
                        </a>
                        <div class="mt-3">
                            <span class="mr-4">$25.00</span>
                            <del>$35.00</del>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <span style="margin-left:40%"><a href="{{url('/allHot')}}" class="btn btn-danger">Xem Tất Cả Sản Phẩm</a></span>
    </div>
</section>