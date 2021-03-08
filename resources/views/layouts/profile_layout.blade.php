<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminPage</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    <style>
        .ck-editor__editable_inline{
            min-height: 150px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Контакты</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('logout')}}" class="nav-link">Выйти из аккаунта</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                @if (session()->has('successChangeOptions'))
                    <div class="alert alert-success">
                        {{session('successChangeOptions')}}
                    </div>
                @endif
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Поиск" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" target="_blank" class="brand-link">
            <img src="{{asset('assets/front/images/version/car-logo.png')}}"
                 alt="AdminLTE Logo"
                 class="brand-image elevation-3"
                 style="opacity: .8; height: 20%">
            <span class="brand-text font-weight-light">На сайт</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(auth()->user()->avatar)
                    <img src="{{asset('storage/'.auth()->user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="assets/front/images/no-image.png" class="img-circle elevation-2" alt="User Image">
                    @endif


                </div>
                <div class="info">
                    <a href="{{route('user.profile')}}" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('user.profile')}}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Профиль</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Категории
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('categories.single',['slug'=>'mercedes-benz'])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mercedes-Benz</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.single',['slug'=>'bmw'])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>BMW</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('categories.single',['slug'=>'mazda'])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mazda</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Статьи
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Список статей</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')

    </div>

    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2020 <a href="{{url('/')}}">CarMarket</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{asset('assets/admin/js/admin.js')}}"></script>
<script>
    $('.nav-sidebar a') .each(function (){
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let  link = this.href;
        if(link == location){
            $(this).addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });
</script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>

</body>
</html>

