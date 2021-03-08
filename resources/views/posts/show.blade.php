@extends('layouts.layout')

@section('title','Car-Information :: ' . $post->title)

@section('content')
    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('categories.single',['slug'=>$post->category->slug])}}">{{$post->category->title}}</a></li>
                <li class="breadcrumb-item active">{{$post->title}}</li>
            </ol>

            <span class="color-yellow"><a href="{{route('categories.single',['slug'=>$post->category->slug])}}" title="">{{$post->category->title}}</a></span>

            <h3>{{$post->title}}</h3>

            <div class="blog-meta big-meta">
                <small>{{$post->getPostDate()}}</small>
                <small><i class="fa fa-eye"></i>{{$post->views}}</small>
            </div><!-- end meta -->

            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <div class="single-post-media">
            <img src="{{asset('storage/'. $post->thumbnail)}}" alt="" class="img-fluid">
        </div><!-- end media -->

        <div class="blog-content">
            {!! $post->content !!}
        </div><!-- end content -->

        <div class="blog-title-area">
            @if($post->tags->count())
            <div class="tag-cloud-single">
                <span>Теги</span>
                @foreach($post->tags as $tag)
                <small><a href="{{route('tags.single', ['slug'=>$tag->slug])}}" title="">{{$tag->title}}</a></small>
                @endforeach
            </div><!-- end meta -->
            @endif

            <div class="post-sharing">
                <ul class="list-inline">
                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div><!-- end post-sharing -->
        </div><!-- end title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="banner-spot clearfix">
                    <div class="banner-img">
                        <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                    </div><!-- end banner-img -->
                </div><!-- end banner -->
            </div><!-- end col -->
        </div><!-- end row -->

        <hr class="invis1">

        <hr class="invis1">

        <div class="custombox clearfix">
            <h4 class="small-title">Возможно вас заинтересуют</h4>
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-6">
                    <div class="blog-box">
                        <div class="post-media">
                            <img src="{{asset('storage/'. $post->thumbnail)}}" alt="" class="img-fluid">
                            <div class="hovereffect">
                                <span class=""></span>
                            </div><!-- end hover -->
                        </div><!-- end media -->
                        <div class="blog-meta">
                            <h4><a href="{{route('posts.single',['slug'=>$post->slug])}}" title="">{{$post->title}}</a></h4>
                            <small><a href="{{route('categories.single',['slug'=>$post->category->slug])}}" title="">{{ $post->category->title }}</a></small>
                            <small>{{$post->getPostDate()}}</small>
                        </div><!-- end meta -->
                    </div><!-- end blog-box -->
                </div><!-- end col -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end custom-box -->

        <hr class="invis1">

        <div class="custombox clearfix">
            <h4 class="small-title">Комментарии</h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="comments-list">
                        <div class="media">
                            <div class="media-body">
                                @foreach($messages as $message)
                                <h4 class="media-heading user_name">{{$message->name}} <small>{{$message->getMessageDate()}}</small></h4>
                                <p>{{$message->comment}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            {{$messages->links()}}
        </div><!-- end custom-box -->


        <hr class="invis1">

        <div class="custombox clearfix">
            <h4 class="small-title">Оставьте свой комментарий</h4>
            <div class="row">
                <div class="col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('message.store')}}" method="post" class="form-wrapper">
                        @csrf

                        <input name="name" type="text" class="form-control" placeholder="Ваше имя">
                        <input name="email" type="email" class="form-control" placeholder="Ваш Email">
                        <textarea name="comment" class="form-control" placeholder="Ваш комментарий"></textarea>
                        <input name="slug" type="hidden" value="{{$slug}}">
                        <button type="submit" class="btn btn-primary">Отправить комментарий</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end page-wrapper -->
@endsection
