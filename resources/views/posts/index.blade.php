@extends('layouts.layout')

@section('title', 'Car-Information')

@section('header')
    <section id="cta" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2>Жизнь есть гонка</h2>
                    <p class="lead">Mercedes-AMG 4-дверное купе</p>
                    <p class="lead"> С 4-дверным купе Mercedes-AMG GT у Вас на выбор имеется не только пять вариантов моделей – AMG GT 43 4MATIC+, AMG GT 53 4MATIC+ и AMG GT 63 S 4MATIC+ – но и многочисленные возможности индивидуализации: три варианта исполнения задней части салона, эксклюзивные пакеты для экстерьера и интерьера, а также широкий выбор лакокрасочных покрытий, колесных дисков и тормозов.</p>
                    <a href="#" class="btn btn-primary">Узнать больше</a>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="newsletter-widget text-center align-self-center">
                        <h3>Подпишитесь на нас!</h3>
                        <p>Подпишитесь на нашу еженедельную рассылку новостей и получайте обновления по электронной почте</p>
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                        </div>
                        <form action="{{route('subscription.store')}}" class="form-inline" method="post">
                            @csrf
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}" required>
                            <input type="submit" value="Подписаться" class="btn btn-default btn-block" />
                        </form>
                    </div><!-- end newsletter -->
                </div>
            </div>
        </div>

    </section>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="blog-custom-build">

            @foreach($posts as $post)
            <div class="blog-box wow fadeIn">
                <div class="post-media">
                    <a href="{{route('posts.single',['slug'=>$post->slug])}}" title="">
                        <img src="{{asset('storage/'. $post->thumbnail)}}" alt="" class="img-fluid">
                        <div class="hovereffect">
                            <span></span>
                        </div>
                        <!-- end hover -->
                    </a>
                </div>
                <!-- end media -->
                <div class="blog-meta big-meta text-center">
                    <div class="post-sharing">
                        <ul class="list-inline">
                            <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                            <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                            <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div><!-- end post-sharing -->
                    <h4><a href="{{route('posts.single',['slug'=>$post->slug])}}" title="">{{$post->title}}</a></h4>
                    <p>{!! $post->description !!}</p>
                    <small><a href="{{route('categories.single',['slug'=>$post->category->slug])}}" title="">{{ $post->category->title }}</a></small>
                    <small>{{$post->getPostDate()}}</small>
                    <small><i class="fa fa-eye"></i> {{$post->views}}</small>
                </div><!-- end meta -->
            </div><!-- end blog-box -->

            <hr class="invis">
            @endforeach
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{$posts->links()}}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->
@endsection

