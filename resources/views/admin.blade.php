@extends('layout')

@section('title', 'Админка')

@section('main_content')
    <h1 class="mb-4">Админка: все посты</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Автор</th>
                <th>Заголовок</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user->name ?? 'Пользователь' }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Удалить пост?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links('pagination::bootstrap-5') }}
@endsection