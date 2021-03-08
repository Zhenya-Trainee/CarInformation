<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Рекомендуемые посты</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($recent_posts as $post)
                                <a href="{{route('posts.single',['slug'=>$post->slug])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="{{asset('storage/'. $post->thumbnail)}}" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">{{$post->title}}</h5>
                                        <small>{{$post->getPostDate()}}</small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Популярные посты</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($popular_posts as $post)
                                <a href="{{route('posts.single',['slug'=>$post->slug])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">{{$post->title}}</h5>
                                        <small>Количество просмотров: <i class="fa fa-eye">{{$post->views}}</i></small>
                                        {{--<span class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                        </span>--}}
                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Категории</h2>
                    <div class="link-widget">
                        @foreach($cats as $cat)
                            <ul>
                                <li><a href="{{route('categories.single',['slug'=>$cat->slug])}}">{{$cat->title}} <span>({{$cat->posts_count}})</span></a></li>
                            </ul>
                        @endforeach
                    </div><!-- end link-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <br>
                <div class="copyright">&copy; Car-Info: <a href="{{route('home')}}">Информация о машинах</a>.</div>
            </div>
        </div>
    </div><!-- end container -->
</footer><!-- end footer -->
