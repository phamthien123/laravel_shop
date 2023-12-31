<section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Sale Product</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($all_products as $productAll)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{asset('product/'.$productAll->image)}}" alt="" />
                        <div class="p_icon">
                            <form action="{{url('add_cart',$productAll->id)}}" method="post">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1" >
                               <input type="submit" value="Add To Cart">
                            </form>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="{{url('product_detail',$productAll->id)}}" class="d-block">
                            <h4>{{$productAll->title}}</h4>
                        </a>
                        <div class="mt-3">
                            <span class="mr-4">{{number_format((int) $productAll->price * (100 - (int) $productAll->discount_price)/100)}} VNĐ</span>
                            <del>{{$productAll->discount_price}}%</del>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <span>
            {!!$all_products->withQueryString()->links('pagination::bootstrap-5')!!}
        </span>
    </div>
</section>
