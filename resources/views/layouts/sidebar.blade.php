<div class="sidebar">
    <div class="widget">
        <h2 class="widget-title">Популярные посты</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                @foreach($popular_posts as $post)
                <a href="{{route('posts.single',['slug'=>$post->slug])}}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="w-100 justify-content-between">
                        <img src="{{asset('storage/'. $post->thumbnail)}}" alt="" class="img-fluid float-left">
                        <h5 class="mb-1">{{$post->title}}</h5>
                        <small>{{$post->getPostDate()}}</small>
                        <small>| <i class="fa fa-eye">{{$post->views}}</i></small>
                    </div>
                </a>
                @endforeach
            </div>
        </div><!-- end blog-list -->
    </div><!-- end widget -->

    <div id="" class="widget">
        <h2 class="widget-title">Реклама</h2>
        <div class="banner-spot clearfix">
            <div class="banner-img">
                <a href="https://www.volkswagen.ru/ru/models/polo-new.html?---=%7B%22models_polo-new_sectiongroup_copy_featureappsection_co%22%3A%22%2F%2B%2F0%22%7D"><img src="/assets/front/images/vw-polo-vi.jpg" alt="" class="img-fluid"></a>
            </div><!-- end banner-img -->
        </div><!-- end banner -->
        <p class="lead">Новый Volkswagen Polo 2020 уже в продаже</p>
    </div><!-- end widget -->

    {{--<div class="widget">
        <h2 class="widget-title">Лента в Instagram</h2>
        <div class="instagram-wrapper clearfix">
            @foreach($posts as $post)
            <a class="" href="#"><img src="{{asset('storage/'. $post->thumbnail)}}" alt="" class="img-fluid"></a>
            @endforeach
        </div><!-- end Instagram wrapper -->
    </div><!-- end widget -->--}}

    <div class="widget">
        <h2 class="widget-title">Категории</h2>
        <div class="link-widget">
            <ul>
                @foreach($cats as $cat)
                    <li><a href="{{route('categories.single',['slug'=>$cat->slug])}}">{{$cat->title}}<span>({{$cat->posts_count}})</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->

    {{--<div class="widget">
        <h2 class="widget-title">Теги</h2>
        <div class="link-widget">
            <ul>
                @foreach($tags as $tag)
                    <li><a href="#">{{$tag->title}}<span>(21)</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
        <div class="card-footer clearfix">
            {{ $tags->links() }}
        </div>
    </div>--}}
</div><!-- end sidebar -->

