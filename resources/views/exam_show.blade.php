@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">{{$exam_type->type}}</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p><b>Eksami tüüp: </b>{{$exam_type->type}}</p>
                    @if (count($exam_type->user) > 0)
                        <p><b>Registreerunud õpilaste arv: </b>{{count($exam_type_users)}}</p>
                        {!! Form::open(['action' => ['ExamController@show', $exam_type->id], 'method' => 'GET']) !!}
                            <div class="form-group pull-left">
                                {{Form::label('study_group', 'Filtreeri õppegrupi põhjal')}}
                                {{Form::select('study_group', $groupsList, ['class' => 'form-control'])}}
                                {{Form::submit('Filtreeri', ['class' => 'btn btn-default btn-xs'])}}
                            </div>
                        {!! Form::close() !!}
                        <br>
                        <br>
                        @if (count($exam_type_users) > 0)
                            <table class="table table-hover table-dark" style="margin-top: 20px;">
                                <thead>
                                    <th></th>
                                    <th>Nimi</th>
                                    <th>Eksami keel</th>
                                    <th>Õppegrupp</th>
                                </thead>
                                @foreach ($exam_type_users as $user)
                                    <tbody>
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$user->first_name}} {{$user->last_name}}</th>
                                        <th>{{$user->exam_lang->language}}</th>
                                        <th>{{$user->group->name}}</th>
                                    </tbody>
                                @endforeach
                            </table>
                        @else
                            <p style="color:red;">Antud õppegrupiga õpilasi eksamile registreeritud ei ole</p>
                        @endif
                    @else
                        <div class="alert alert-info alert-block">
                            <strong>Antud eksamile ei ole ühtegi õpilast registreeritud</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection