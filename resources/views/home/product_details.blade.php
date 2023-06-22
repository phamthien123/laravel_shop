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
  <section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content d-md-flex justify-content-between align-items-center">
          <div class="mb-3 mb-md-0">
            <h2>Product Details</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <!--================Single Product Area =================-->
  <div class="product_image_area">
    <div class="container">
      @foreach($product_details as $item)
      <div class="row s_product_inner">
        <div class="col-lg-6">
          <div class="s_product_img">
            <!-- ẢNH Nhỏ-->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <!-- ẢNH Lớn-->
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{asset('product/'.$item->image)}}" alt="First slide" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <div class="s_product_text">
            <h3>{{$item->title}}</h3>
            <h2>{{number_format ($item->price)}}VNĐ</h2>
            <ul class="list">
              <li>
                <span>Category</span> : {{$item->category_name}}
              </li>
              <li>
                <span>Quantity</span> : {{$item->quantity}}
              </li>
            </ul>
            <p>
              {{$item->description}}
            </p>
            <div class="product_count">
              <label for="qty">Quantity:</label>
              <form action="{{url('add_cart',$item->pid)}}" method="post">
                @csrf
                <input type="number" name="quantity" value="1" min="1">
                <input type="submit" value="Add To Cart">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!--================End Single Product Area =================-->
    @include('home.product-related')
    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <p>
              Beryl Cook is one of Britain’s most talented and amusing artists
              .Beryl’s pictures feature women of all shapes and sizes enjoying
              themselves .Born between the two world wars, Beryl Cook eventually
              left Kendrick School in Reading at the age of 15, where she went
              to secretarial school and then into an insurance office. After
              moving to London and then Hampton, she eventually married her next
              door neighbour from Reading, John Cook. He was an officer in the
              Merchant Navy and after he left the sea in 1956, they bought a pub
              for a year before John took a job in Southern Rhodesia with a
              motor company. Beryl bought their young son a box of watercolours,
              and when showing him how to use it, she decided that she herself
              quite enjoyed painting. John subsequently bought her a child’s
              painting set for her birthday and it was with this that she
              produced her first significant work, a half-length portrait of a
              dark-skinned lady with a vacant expression and large drooping
              breasts. It was aptly named ‘Hangover’ by Beryl’s husband and
            </p>
            <p>
              It is often frustrating to attempt to plan meals that are designed
              for one. Despite this fact, we are seeing more and more recipe
              books and Internet websites that are dedicated to the act of
              cooking for one. Divorce and the death of spouses or grown
              children leaving for college are all reasons that someone
              accustomed to cooking for more than one would suddenly need to
              learn how to adjust all the cooking practices utilized before into
              a streamlined plan of cooking that is more efficient for one
              person creating less
            </p>
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
              <div class="col-lg-6">
                @foreach($comment as $comments)
                <div class="comment_list">
                  <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img src="{{asset('home/img/product/single-product/review-1.png')}}" alt="" />
                      </div>
                      <div class="media-body">
                        <h4>{{$comments->name}}</h4>
                        <h5>{{$comments->created_at}}</h5>
                      </div>
                    </div>
                    <p>
                      {{$comments->comment}}
                    </p>
                  </div>
                </div>
                <a class="btn btn-success" href="javascript::void(0)" onclick="reply(this)" data-Comment_id="{{$comments->id}}" style="margin-top:20px;margin-left:80%">Reply</a>

                @foreach($reply as $replies)
                @if($replies->comment_id == $comments->id)
                <div class="review_item reply">
                  <div class="media">
                    <div class="d-flex">
                      <img src="{{asset('home/img/product/single-product/review-2.png')}}" alt ="" style="margin-top: 10px;"/>
                    </div>
                    <div class="media-body">
                      <h4>{{$replies->name}}</h4>
                      <h5>{{$replies->created_at}}</h5>
                    </div>
                  </div>
                  <h3 style="margin-left: 85px;">
                    {{$replies->reply}}
                  </h3>
                  <a class="btn btn-success" href="javascript::void(0)" onclick="reply(this)" data-Comment_id="{{$comments->id}}" style="margin-top:20px;margin-left:18%">Reply</a>
                </div>
                @endif
                @endforeach

                @endforeach
                <div style="display: none;" class="ReplyDiv">
                  <form action="{{url('add_reply')}}" method="Post">
                    @csrf
                    <span>
                      <input type="hidden" name="product_id_reply" id="" value="{{$item->pid}}">
                    </span>
                    <input type="hidden" id="Comment_id" name="Comment_id">
                    <textarea style="height: 100px;width: 500px; margin-top:20px" placeholder="Write Reply Something" name="reply" required=""></textarea>
                    <button type="submit" value="submit" class="btn submit_btn">
                      Submit Now
                    </button>
                    <a class="btn btn-danger" href="javascript::void(0)" onclick="reply_close(this)">Close</a>
                  </form>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="review_box">
                  <h4>Post a comment</h4>
                  <form class="row contact_form" action="{{url('add_comment')}}" method="post" id="contactForm" novalidate="novalidate">
                    @csrf
                    <div class="col-md-12">
                      <span>
                        <input type="hidden" name="product_id" id="" value="{{$item->pid}}">
                      </span>
                      <div class="form-group">
                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message" style="height: 100px;"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button type="submit" value="submit" class="btn submit_btn">
                        Submit Now
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endforeach
    <!--================End Product Description Area =================-->

    <!--================ start footer Area  =================-->
    @include('home.footer')
    <!--================ End footer Area  =================-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
      function reply(caller) {
        document.getElementById('Comment_id').value = $(caller).attr('data-Comment_id');
        $('.ReplyDiv').insertAfter($(caller));
        $('.ReplyDiv').show();
      }

      function reply_close(caller) {
        $('.ReplyDiv').hide();
      }
    </script>
      <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
    
    @include('home.js')
</body>

</html>