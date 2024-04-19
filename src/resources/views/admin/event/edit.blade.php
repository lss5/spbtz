@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавление события</h1>
                </div>
                {{-- <div class="col-sm-6">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-primary float-sm-right">События</a>
                </div> --}}
            </div>
        </div>
    </div>

    <section class="content">
        <form method="POST" action="{{ route('admin.events.update', $event) }}">
            @csrf
            @method('PATCH')
            <div class="col-12">
                <div class="mb-3">
                    <label for="title" class="form-label">Заговолок</label>
                    <input type="text" value="{{ old('title') ?? $event->title}}" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Ваше имя">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea name="description" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description') ?? $event->description}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success mx-1" role="button">Сохранить</button>
                <a href="{{ route('admin.events.index') }}" type="button" class="btn btn-outline-secondary">Отмена</a>
            </div>
        </form>
    </section>
</div>
   
@endsection
