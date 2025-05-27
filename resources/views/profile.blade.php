@extends('layout')

@section('title', 'Профиль '. Auth::user()->name)

@section('main_content')
<style>
    .avatar-edit-wrap {
        position: relative;
        display: inline-block;
    }
    .avatar-edit-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(30,30,30,0.65);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        border-radius: 50%;
        cursor: pointer;
        transition: opacity 0.2s;
        font-size: 1.1em;
        font-weight: 500;
        text-align: center;
        z-index: 2;
    }
    .avatar-edit-wrap:hover .avatar-edit-overlay {
        opacity: 1;
    }
    .avatar-edit-input {
        display: none;
    }
</style>

<div class="container py-4">
    <div class="bg-dark rounded-4 shadow-lg p-4 text-white mb-4">
        <div class="vk-profile-block mb-4">
            <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" id="avatar-form">
                @csrf
                <div class="avatar-edit-wrap" style="width:80px; height:80px;">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" width="80" height="80" class="rounded-circle border border-secondary" id="avatar-img">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Аватар" width="80" height="80" class="rounded-circle border border-secondary" id="avatar-img">
                    @endif
                    <div class="avatar-edit-overlay" onclick="document.getElementById('avatar-input').click()">
                        <i class="bi bi-camera"></i><br>Изменить
                    </div>
                    <input type="file" name="avatar" id="avatar-input" class="avatar-edit-input" accept="image/*" onchange="document.getElementById('avatar-form').submit()">
                </div>
            </form>
            <div>
                <h1 class="mb-1 fs-3">{{ Auth::user()->name }}</h1>
                <p class="mb-1 text-secondary">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <h2 class="mb-3" style="color: #bdbdbd;">Ваши посты</h2>
        @if($posts->count())
            <div class="d-flex flex-column gap-4">
                @foreach($posts as $post)
                    <div class="vk-post-card rounded-4 p-0 shadow-sm position-relative" style="max-width: 650px; margin-bottom: 8px;">
                        <div class="vk-profile-block" style="border-bottom: none; border-radius: 16px 16px 0 0; margin-bottom: 0; background: #232526;">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" width="48" height="48" class="rounded-circle border border-secondary me-2">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Аватар" width="48" height="48" class="rounded-circle border border-secondary me-2">
                            @endif
                            <div>
                                <span class="fw-bold" style="color: #bdbdbd;">{{ Auth::user()->name }}</span>
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
                                <form method="POST" action="{{ route('posts.like', $post->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-secondary px-3"
                                        @if(auth()->check() && is_array($post->liked_users) && in_array(auth()->id(), $post->liked_users)) disabled @endif>
                                        <i class="bi bi-heart{{ auth()->check() && is_array($post->liked_users) && in_array(auth()->id(), $post->liked_users) ? '-fill text-danger' : '' }}"></i>
                                        {{ $post->likes }}
                                    </button>
                                </form>
                                <button class="btn btn-sm btn-outline-secondary px-3" disabled>
                                    <i class="bi bi-chat"></i> Комментировать
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-secondary mt-3">У вас пока нет постов.</p>
        @endif
    </div>
</div>

{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@endsection