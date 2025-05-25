@extends('layout')

@section('title', 'Профиль '. Auth::user()->name)

@section('main_content')
    <h1>Профиль</h1>
    <p>Имя: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    @if(Auth::user()->avatar)
        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Аватар" width="100">
    @else
        <img src="{{ asset('images/default-avatar.png') }}" alt="Аватар" width="100">
    @endif
@endsection