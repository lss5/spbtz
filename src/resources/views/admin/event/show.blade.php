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
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $event->description }}</h3>
                <div class="card-tools">
                    @can('update', $event)
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-success float-sm-right mr-1">Изменить</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <li id="participants_count" class="list-group-item list-group-item-warning">Участники: {{ $event->participants()->count() }}</li>
                    @if ($event->participants()->count() > 0)
                        @foreach ($event->participants()->get() as $user)
                            <button id="participant_{{$user->id}}" type="button" class="list-group-item list-group-item-action">{{$user->first_name.' '.$user->last_name}}</button>
                        @endforeach
                    @endif
                    </div>
                </div>

            <div class="card-footer">
                @if($participant)
                    <button id="participant_status" class="btn btn-warning">Отказаться от участия</a>
                @else
                    <button id="participant_status" class="btn btn-warning">Принять участие</a>
                @endif
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalWindow" tabindex="-1" role="dialog" aria-labelledby="ModalWindowLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalWindowLabel">Информация об участнике события</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_js')
    <script>
        $(document).ready(function(){
            function getUserData(id) {
                $.ajax({
                    url: '{{ route("admin.user.show") }}',
                    method: 'GET',
                    data: {
                        id: id,
                    },
                })
                .done(function(data) {
                    if (data.error == null) {
                        $('#ModalWindowLabel').html('Информация об участнике события');
                        $('div[class="modal-body"]').html(data.result.first_name + ' ' + data.result.last_name + '</br> Дата рождения: ' + data.result.date_birthday);
                        $('#ModalWindow').modal();
                    } else {
                        $('#ModalWindowLabel').html('Произошла ошибка!');
                        $('div[class="modal-body"]').html(data.error);
                        $('#ModalWindow').modal();
                    }
                })
                .fail(function() {
                    $('#ModalWindowLabel').html('Произошла ошибка!');
                    $('div[class="modal-body"]').html('Обновите страницу');
                    $('#ModalWindow').modal();
                })
            }

            $('div[class="card-body"] button[id^="participant_"]').click(function(){
                let id = $(this).attr('id').replace(/[^0-9]/gi, '');
                getUserData(id);
            });

            function participantChangeStatus(id) {
                $.ajax({
                    url: '{{ route("admin.events.participant", $event->id) }}',
                    method: 'POST',
                    data: {},
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                })
                .done(function(data) {
                    if (data.error == null) {
                        if (data.participant == 'attach') {
                            $('div[class="card-body"] li[id="participants_count"]').html('Участники: ' + data.participants_count);
                            let new_participant = $('div[class="card-body"] div[class="list-group"]').append($('<button>', {
                                id: 'participant_{{Auth::id()}}',
                                type: 'button',
                                class: 'list-group-item list-group-item-action',
                                text: '{{Auth::user()->first_name}} {{Auth::user()->last_name}}',
                            }));
                            $('div[class="card-body"] button[id="participant_{{Auth::id()}}"]').click(function(){
                                getUserData({{Auth::id()}});
                            });
                            $('button[id="participant_status"]').text('Отказаться от участия');
                        }
                        if (data.participant == 'detach') {
                            $('div[class="card-body"] li[id="participants_count"]').html('Участники: ' + data.participants_count);
                            $('div[class="card-body"] button[id="participant_{{Auth::id()}}"]').remove();
                            $('button[id="participant_status"]').text('Принять участие');
                        }
                    } else {
                        $('#ModalWindowLabel').html('Произошла ошибка!');
                        $('div[class="modal-body"]').html(data.error);
                        $('#ModalWindow').modal();
                    }
                })
                .fail(function() {
                    $('#ModalWindowLabel').html('Произошла ошибка!');
                    $('div[class="modal-body"]').html('Обновите страницу');
                    $('#ModalWindow').modal();
                })
            }

            $('button[id="participant_status"]').click(function(){
                participantChangeStatus();
            });
        });
    </script>
@endsection
