@extends('layouts.auth')

@section('content')
    
<div class="row">
    <div class="col-12 col-lg-8 mx-auto">
        <h3 class="h4 my-2">Авторизация</h3>
        <hr class="py-1">
        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-lg-3">
                    <label for="login">Login</label>
                </div>
                <div class="col-sm-12 col-lg-9 form-group">
                    @error('login')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    <input name="login" value="{{ old('login') }}" type="text" class="form-control @error('login') is-invalid @enderror">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-3">
                    <label for="password">Password</label>
                </div>
                <div class="col-sm-12 col-lg-9 form-group">
                    @error('password')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                </div>
            </div>

            <hr class="pb-1">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-success mx-1" role="button" aria-pressed="true">Войти</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection