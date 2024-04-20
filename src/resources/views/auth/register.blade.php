@extends('layouts.main')

@section('content')

    <form method="POST" action="{{ route('registration') }}">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-6 mx-auto">
                <h3 class="h4 my-2">Регистрация</h3>
                <hr class="py-1">
                <div class="mb-3">
                    <label for="first_name" class="form-label">Имя</label>
                    <input type="text" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Ваше имя">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="text" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Ваша фамилия">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="date_birthday" class="form-label">Дата рождения</label>
                    <input type="text" value="{{ old('date_birthday') ?? ''}}" class="form-control @error('date_birthday') is-invalid @enderror" name="date_birthday" id="date_birthday" placeholder="Дата рождения">
                    @error('date_birthday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" value="{{ old('login') }}" class="form-control @error('login') is-invalid @enderror" name="login" id="login" placeholder="Ваш логин">
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Пароль">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Подтверждение пароля">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="pb-1">
        <div class="row">
            <div class="col-12 col-lg-6 mx-auto mb-3">
                <button type="submit" class="btn btn-success mx-1" role="button">Зарегистрироваться</button>
                <a href="{{ route('index') }}" type="button" class="btn btn-outline-secondary">Отмена</a>
            </div>
        </div>
    </form>

@endsection

@section('custom_js')
    <script>
        $(function() {
            $('input[name="date_birthday"]').daterangepicker({
                autoUpdateInput: false,
                startDate: moment().startOf('hour'),
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'), 10)
            });
        });

        $('input[name="date_birthday"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY'));
        });
    </script>
@endsection
