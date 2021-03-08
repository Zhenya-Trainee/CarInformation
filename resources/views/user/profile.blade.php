@extends('layouts.profile_layout')

@section('title', 'Car-Information ::' )

@section('content')
    <div class="content-wrapper" style="min-height: 1662.75px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ваш профиль</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if(auth()->user()->avatar)
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('storage/'.auth()->user()->avatar)}}" alt="User profile picture" style="width: 80%;">
                                    @else
                                        <img src="assets/front/images/no-image.png" class="profile-user-img img-fluid img-circle" alt="User Image">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

                                <p class="text-muted text-center">Вы авторизованы</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Ваш Email</b> <a class="float-right">{{auth()->user()->email}}</a>
                                    </li>
                                    @if(auth()->user()->verified == false)
                                        <li class="text-center list-group-item bg-warning">
                                            <b>Подтвердите свой Email</b>
                                        </li>
                                    @endif
                                </ul>

                                <a href="{{route('logout')}}" class="btn btn-primary btn-block"><b>Выйти из аккаунта</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Обо мне</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Образование</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Локация</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Скилы</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>

                                <hr>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Настройки аккаунта</a>
                                    </li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <div class="tab-pane" id="settings">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="list-unstyled">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{route('user.update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Имя</label>
                                                    <div class="col-sm-10">
                                                        <input name="name" type="text" class="form-control" id="inputName"
                                                               value="{{auth()->user()->name}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail"
                                                           class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input name="email" type="email" class="form-control" id="inputEmail"
                                                               value="{{auth()->user()->email}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPassword"
                                                           class="col-sm-2 col-form-label">Пароль</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="password" class="form-control" placeholder="Введите пароль">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail"
                                                           class="col-sm-2 col-form-label">Пароль</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Повторите пароль">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="avatar">Ваше фото</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file"  name="avatar" class="custom-file-input" id="avatar">
                                                            <label class="custom-file-label" for="avatar">Выберите файл</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

