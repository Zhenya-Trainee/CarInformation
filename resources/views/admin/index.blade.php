@extends('admin.layouts.layout')


@section('content')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Главная страница</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">На главную</a></li>
                            <li class="breadcrumb-item active">Home page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Информация о постах</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{route('posts.create')}}" class="btn btn-primary mb-3">Добавить статью</a>
                    @if(count($posts))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 10px">№</th>
                                    <th>Название</th>
                                    <th>Категория</th>
                                    <th>Кол-во просмотров</th>
                                    <th>Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>{{ $post->views}}</td>
                                        <td>{{ $post->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Статей пока нет ...</p>
                    @endif
                    <div class="card-footer clearfix">
                        {{ $posts->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <strong> Всего просмотров: | {{$sumViews}} |</strong>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Категории</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($cats))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Название категории</th>
                                    <th>Количество постов в категории</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cats as $cat)
                                    <tr>
                                        <td>{{ $cat->title }}</td>
                                        <td>{{ $cat->posts_count}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Категорий пока нет ...</p>
                    @endif
                    <div class="card-footer clearfix">
                        {{ $cats->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <strong> Всего категорий: | {{$cats->count()}} |</strong>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

@endsection
