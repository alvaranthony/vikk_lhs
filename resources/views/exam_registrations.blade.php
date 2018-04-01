@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Eksamite registreeringud</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-hover table-dark" style="margin-top: 20px;">
                        <thead>
                            <th></th>
                            <th>Eksami tüüp</th>
                            <th></th>
                        </thead>
                        @foreach ($exam_types as $exam)
                            <tbody>
                                <th>{{$loop->iteration}}</th>
                                <th><a href="/exams/{{$exam->id}}" class="btn btn-primary btn-xs">{{$exam->type}}</a></th>
                                <th>Registreeringuid: {{count($exam->user)}}</th>
                                <th></th>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection