<header class="market-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}"><img src="/assets/front/images/version/car-logo.png" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">На главную</a>
                    </li>
                    <div class="newMenu">
                        <li class="nav-item">
                            <a class="nav-link">Категории</a>
                            <ul class="slide-my">
                                @foreach($cats as $cat)
                                    <li><a class="nav-link" href="{{route('categories.single',['slug'=>$cat->slug])}}">{{$cat->title}}</a></li>
                                @endforeach
                            </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contacts.single')}}">Наши контакты</a>
                    </li>
                    <li class="nav-item">
                        @guest()
                            <a class="nav-link" href="{{route('login.create')}}">Войти</a>
                        @endguest
                    </li>
                    <li class="nav-item">
                        @if (session()->has('successMessage'))
                            <div class="alert alert-success">
                                {{session('successMessage')}}
                            </div>
                        @endif

                            @if (session()->has('successRegister'))
                                <div class="alert alert-success">
                                    {{session('successRegister')}}
                                </div>
                            @endif

                        @if (session()->has('successAuth'))
                            <div class="alert alert-success">
                                {{session('successAuth')}}
                            </div>
                        @endif
                    </li>
                </ul>
                <form class="form-inline" method="get" action="{{route('search')}}">
                    @auth()
                        @if(auth())
                            <ul class="navbar-nav mr-auto">
                                <li>
                                    <a class="nav-link" href="{{route('user.profile')}}">{{auth()->user()->name}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mr-3" href="{{route('logout')}}">Выйти</a>
                                </li>
                            </ul>
                        @endif
                    @endauth
                    <input name="s" class="form-control mr-sm-2 @error('s') is-invalid @enderror" type="text" placeholder="Поиск по сайту"  required>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
                </form>

                <style>
                    .market-header .form-inline .form-control.is-invalid{
                        border: 2px solid red;
                    }
                </style>

            </div>
        </nav>
    </div><!-- end container-fluid -->
</header><!-- end market-header -->

