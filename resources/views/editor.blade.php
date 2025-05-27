@extends('layout')

@section('title', 'Новая запись для ' . Auth::user()->name)

@section('main_content')

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/lang/summernote-ru-RU.min.js"></script>

    <div class="d-flex align-items-center mb-4 mt-4">
        <div>
            @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" width="100" height="100" class="rounded-circle border border-secondary me-4">
            @else
                <img src="{{ asset('images/default-avatar.png') }}" alt="Аватар" width="100" height="100" class="rounded-circle border border-secondary me-4">
            @endif
        </div>
        <div>
            <h1 class="mb-1">{{ Auth::user()->name }}</h1>
            <p class="mb-0 text-secondary">{{ Auth::user()->email }}</p>
        </div>
    </div>
    <hr class="my-4">

    <h2>Добавить новый пост</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Введите заголовок" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Текст поста</label>
            <textarea name="content" id="content" rows="8" class="form-control" placeholder="Введите текст поста" >{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Изображение (необязательно)</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Опубликовать</button>
    </form>
    
@endsection