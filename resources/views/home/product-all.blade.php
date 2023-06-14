<section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>All Product</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($productAlls as $productAll)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{asset('product/'.$productAll->image)}}" alt="" />
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
            {!!$productAlls->withQueryString()->links('pagination::bootstrap-5')!!}
        </span>
    </div>
</section>