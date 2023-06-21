<section class="blog-area section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>New Blog</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($blog as $item)
            <div class="col-lg-4 col-md-6">
                <div class="single-blog">
                    <div class="thumb">
                        <img class="img-fluid" src="{{asset('blog/'.$item->image)}}" alt="">
                    </div>
                    <div class="short_details">
                        <a class="d-block" href="single-blog.html">
                            <h4>{{$item->title}}</h4>
                        </a>
                        <div class="text-wrap">
                            <p>
                            {{substr($item->description,0,120)}}
                            </p>
                        </div>
                        <a href="{{$item->link}}" class="blog_btn" target="_blank">Learn More <span class="ml-2 ti-arrow-right"></span></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</section>