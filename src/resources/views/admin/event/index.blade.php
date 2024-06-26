@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Учавствую в событиях</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.events.create') }}" class="btn btn-success float-sm-right">Создать</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        @if ($events_participant->count() > 0)
            @foreach ($events_participant as $event)
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.events.show', $event) }}" class="text-decoration_none">
                            <h3 class="card-title">{{ $event->title }}</h3>
                        </a>
                        @can('update', $event)
                            <div class="card-tools">
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-success">Изменить</a>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        {{ $event->description }}
                    </div>
                    <div class="card-footer">
                        <span class="badge badge-warning">Участники: {{ $event->participants()->count() }}</span>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Вы пока не учавствуете в событиях</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-success">Посмотреть все события</a>
                </div>
            </div>
        @endif
        
    </section>
</div>

@endsection
