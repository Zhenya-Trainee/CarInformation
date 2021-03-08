@extends('layouts.contact_layout')

@section('title', 'Car-Information :: Контакты')

@section('page_title')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>Вы можете отправить свое сообщение нам на почту и мы с вами свяжемся</h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->
@endsection

@section('content')
        <div class="container">
                    <div class="page-wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Кто мы?</h4>
                                <p>Car-Information - это личный блог, в котором собраны материалы работ, фотографии, информация от независимых работников со всего мира.</p>
                            </div>

                            <div class="col-lg-6">
                                <h4>Как мы помогаем?</h4>
                                <p>Если вы хотите написать нам, разместить у нас рекламу или просто поздороваться, заполните форму ниже, и мы свяжемся с вами в ближайшее время.</p>
                            </div>
                        </div><!-- end row -->

                        <hr class="invis">
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
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{route('contacts.store')}}" class="form-wrapper" method="post">
                                    @csrf
                                    <h4>Форма обратной связи</h4>
                                    <input name="name" type="text" class="form-control" placeholder="Ваше Имя">
                                    <input name="email" type="email" class="form-control" placeholder="Ваш Email">
                                    <input name="phone" type="text" class="form-control" placeholder="Телефон">
                                    <textarea name="message" class="form-control" placeholder="Ваше сообщение"></textarea>
                                    <button type="submit" class="btn btn-primary">Отправить сообщение <i class="fa fa-envelope-open-o"></i></button>
                                </form>
                            </div>
                        </div>
                </div><!-- end col -->
        </div><!-- end container -->
@endsection


