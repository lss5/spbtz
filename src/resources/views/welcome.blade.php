@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 col-lg-4 mx-auto mt-1 mt-lg-3">
        @guest
            <a class="btn btn-success w-100" href="{{ route('login') }}">Войти</a>
            
            @if (Route::has('registration'))
                <a class="btn btn-outline-success w-100 mt-2" href="{{ route('showRegistrationForm') }}">Регистрация</a>
            @endif
        @else
            <a href="{{ route('admin.index') }}" class="btn btn-primary w-100">Панель управления</a>
            <a href="{{ route('logout') }}" class="btn btn-outline-primary w-100 mt-2"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            Выйти</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endguest
    </div>
</div>


@endsection
