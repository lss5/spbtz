@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $event->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-primary float-sm-right">К списку</a>
                    @can('update', $event)
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-success float-sm-right mr-1">Изменить</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $event->title }}</h3>
                <div class="card-tools">
                    <span class="badge badge-warning">Участники: {{ $event->participants()->count() }}</span>
                </div>
            </div>
            <div class="card-body">
                {{ $event->description }}
            </div>
            <div class="card-footer">
                @can('update', $event)
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">Принять участие</a>
                @endcan
            </div>
        </div>
    </section>
</div>

@endsection
