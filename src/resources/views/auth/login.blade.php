@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 col-lg-6 mx-auto">
        <h3 class="h4 my-2">Авторизация</h3>
        <hr class="py-1">
        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" name="login" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" placeholder="Введите логин">
                @error('login')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <hr class="pb-1">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">Войти</button>
                    <a href="{{ route('index') }}" type="button" class="btn btn-outline-secondary">Отмена</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection