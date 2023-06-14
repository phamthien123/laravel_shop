<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.head')
</head>

<body>
  <!--================Home Banner Area =================-->
  @include('home.header')
  <!--================End Home Banner Area =================-->

  <!--================Home Banner Area =================-->
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content d-md-flex justify-content-between align-items-center">
          <div class="mb-3 mb-md-0">
            <h2>All Product Hot</h2>
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
          <div class="latest_product_inner">
            <div class="row">
              @foreach($allPro_hot as $allItem)
              <div class="col-lg-4 col-md-6">
                <div class="single-product">
                  <div class="product-img">
                    <img class="card-img" src="{{asset('product/'.$allItem->image)}}" alt="" />
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
                      <h4>{{$allItem->title}}</h4>
                    </a>
                    <div class="mt-3">
                      <span class="mr-4">{{number_format($allItem->price)}}VNĐ</span>
                      <del>{{$allItem->discount_price}}%</del>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <span>
              {!!$allPro_hot->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
          </div>
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
  @include('home.js')
</body>

</html>