@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Praktikate andmed</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    {!! Form::open(['action' => ['InternshipController@index'], 'method' => 'GET']) !!}
                        <div class="form-group pull-right">
                            <div class="form-group">
                                {{Form::label('company_name', 'Otsi firma järgi')}}
                                {{Form::text('company_name', '', ['class' => 'form-control'])}}
                            </div>
                            {{Form::submit('Otsi', ['class' => 'btn btn-default btn-xs'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Praktikate arv: {{count($internships_all)}}</h4>
                    @if (count($internships_all) > 0)
                        <table class="table table-hover table-dark" style="margin-top: 20px;">
                            <thead>
                                <th></th>
                                <th>Õpilane</th>
                                <th>Ettevõte</th>
                                <th>Alustamise kuupäev</th>
                                <th>Lõpetamise kuupäev</th>
                                <th>Maht akadeemilistes tundides</th>
                            </thead>
                            @foreach($internships_all as $intern)
                            <tbody>
                                <th>{{$loop->iteration}}</th>
                                <th>
                                    {{$intern->user->first_name}} {{$intern->user->last_name}}
                                </th>
                                <th>{{$intern->company_name}}</th>
                                <th>{{$intern->start_date}}</th>
                                <th>{{$intern->end_date}}</th>
                                <th>{{$intern->duration}}</th>
                            </tbody>
                            @endforeach
                        </table>
                    @else
                        <h4 style="color:red;">Praktikate andmed puuduvad!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
