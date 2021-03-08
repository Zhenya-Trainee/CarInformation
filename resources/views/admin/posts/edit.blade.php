@extends('admin.layouts.layout')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">На главную</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">"{{$post->title}}"</h3>
                        </div>
                        <form role="form" method="post" action="{{route('posts.update', ['post'=>$post->id])}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{$post->title}}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Краткое содержание</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2" name="description">{{$post->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Контент</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" rows="7" name="content">{{$post->content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Выберите категорию</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                        @foreach($categories as $k=>$v)
                                            <option value="{{$k}}" @if($k == $post->category_id) selected @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Теги</label>
                                    <select name="tags[]" id="tags" class="select2" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;">
                                        @foreach($tags as $k=>$v)
                                            <option value="{{$k}}" @if(in_array($k, $post->tags->pluck('id')->all())) selected @endif>{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"  name="thumbnail" class="custom-file-input" id="thumbnail">
                                            <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                                        </div>
                                    </div>
                                <div>
                                    @if($post->thumbnail)
                                        <img src="{{asset('storage/'. $post->thumbnail)}}" alt="Ваша загруженная картинка" style="width: 35%;" class="img-thumbnail mt-2 mb-2">
                                    @else
                                    <img src="{{asset('assets/admin/img/no-image.png')}}" alt="Каринка не найдена" class="img-thumbnail mt-2" style="width: 35%;">
                                    @endif
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
@endsection


