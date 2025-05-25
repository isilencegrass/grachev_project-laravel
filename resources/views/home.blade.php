@extends('layout')

@section('title', 'Главная страница')

@section('main_content')
    <h1 class="mb-4">Лента постов</h1>
    <div class="d-flex flex-column gap-4">
        @foreach($posts as $post)
            <div class="vk-post-card rounded-4 p-0 shadow-sm position-relative" style="max-width: 650px; margin-bottom: 8px;">
                <div class="vk-profile-block" style="border-bottom: none; border-radius: 16px 16px 0 0; margin-bottom: 0; background: #232526;">
                    @if($post->user && $post->user->avatar)
                        <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="Аватар" width="48" height="48" class="rounded-circle border border-secondary me-2">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Аватар" width="48" height="48" class="rounded-circle border border-secondary me-2">
                    @endif
                    <div>
                        <span class="fw-bold" style="color: #bdbdbd;">{{ $post->user->name ?? 'Пользователь' }}</span>
                        <div class="text-light small">{{ $post->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                </div>
                <div class="p-4 pt-3">
                    <h5 class="fw-semibold mb-2" style="color: #bdbdbd;">{{ $post->title }}</h5>
                    @php
                        $plainContent = strip_tags($post->content);
                        $shortContent = \Illuminate\Support\Str::limit($plainContent, 250);
                        $isLong = mb_strlen($plainContent) > 250;
                    @endphp
                    <div class="vk-post-content" id="post-content-{{ $post->id }}">
                        {!! nl2br(e($shortContent)) !!}
                        @if($isLong)
                            <span class="vk-post-more d-none">{!! nl2br(e(mb_substr($plainContent, 250))) !!}</span>
                        @endif
                    </div>
                    @if($isLong)
                        <button class="vk-show-more" type="button" data-post="{{ $post->id }}" style="color: #bdbdbd;">Показать больше</button>
                    @endif
                    @if($post->media)
                        <div class="vk-post-media mt-3">
                            @foreach(json_decode($post->media, true) as $img)
                                <img src="{{ asset('storage/' . $img) }}" alt="Изображение поста" class="img-fluid rounded" style="max-height:220px; border: 1px solid #bdbdbd;">
                            @endforeach
                        </div>
                    @endif
                    <div class="d-flex gap-3 mt-3">
                        <button class="btn btn-sm btn-outline-secondary px-3" disabled>
                            <i class="bi bi-heart"></i> Нравится
                        </button>
                        <button class="btn btn-sm btn-outline-secondary px-3" disabled>
                            <i class="bi bi-chat"></i> Комментировать
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>

@endsection