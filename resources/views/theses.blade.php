@extends('layouts.app')


@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Lõputööde andmed</div>
                <div class="panel-body">
                    {!! Form::open(['action' => ['ThesesController@index'], 'method' => 'GET']) !!}
                        <div class="form-group pull-left">
                            {{Form::label('thesis_status', 'Filtreeri staatuse põhjal')}}
                            {{Form::select('thesis_status', $statusList, ['class' => 'form-control'])}}
                            {{Form::submit('Filtreeri', ['class' => 'btn btn-default btn-xs'])}}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['action' => ['ThesesController@index'], 'method' => 'GET']) !!}
                        <div class="form-group pull-right">
                            <div class="form-group">
                                {{Form::label('name', 'Otsi nime/teema põhjal')}}
                                {{Form::text('name', '', ['class' => 'form-control'])}}
                            </div>
                            {{Form::submit('Otsi', ['class' => 'btn btn-default btn-xs'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                {!! Form::open(['action' => ['ThesesController@index'], 'method' => 'GET']) !!}
                    <div class="form-group pull-left">
                        {{Form::label('study_group', 'Filtreeri õppegrupi põhjal')}}
                        {{Form::select('study_group', $groupsList, ['class' => 'form-control'])}}
                        {{Form::submit('Filtreeri', ['class' => 'btn btn-default btn-xs'])}}
                    </div>
                {!! Form::close() !!}
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Lõputööde arv: {{count($theses_all)}}</h4>
                    @if (count($theses_all) > 0)
                        <table class="table table-hover table-dark" style="margin-top: 20px;">
                            <thead>
                                <th></th>
                                <th>Õpilane</th>
                                <th>Lõputöö nimi</th>
                                <th>Kaitsmise kuupäev</th>
                                <th>Staatus</th>
                                <th>Õppegrupp</th>
                                <th>Juhendaja</th>
                                <th>Lõputöö fail</th>
                            </thead>
                            @foreach($theses_all as $thesis)
                            <tbody>
                                <th>{{$loop->iteration}}</th>
                                <th>
                                    {{$thesis->author->first()->first_name}}
                                    {{$thesis->author->first()->last_name}}
                                </th>
                                <th>{{$thesis->name}}</th>
                                <th>{{$thesis->defense_date}}</th>
                                <th>{{$thesis->status->name}}</th>
                                <th>{{$thesis->group->name}}</th>
                                <th>
                                    {{$thesis->instructor->first()->first_name}}
                                    {{$thesis->instructor->first()->last_name}}
                                </th>
                                <th>
                                    @if (count($thesis->fileentry) > 0)
                                        @foreach ($thesis->fileentry as $fileentry)
                                            <a href="{{route('getentry', $fileentry->filename)}}" class="material-icons">file_download</a>
                                            {{$fileentry->original_filename}}<br><br>
                                        @endforeach
                                    @else
                                        Pole lisatud!
                                    @endif
                                </th>
                                <th></th>
                             @endforeach
                        </table>
                    @else
                        <h4 style="color:red;">Lõputöö andmed puuduvad!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
