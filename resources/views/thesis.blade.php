@extends('layouts.app')


@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                                <div class="panel-heading">{{$thesis->name}}</div>
                                <div class="panel-body">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                <p><b>Teema: </b>{{$thesis->name}}</p>
                                <p>
                                    <b>Töö autor: </b>
                                    @foreach($thesis->user as $user)
                                        @if($user->pivot->role_id === 1)
                                            @foreach($users_all as $student)
                                                @if($student->id === $user->id)
                                                    {{$student->full_name}}
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </p>
                                <p><b>Kaitsmise kuupäev: </b>{{$thesis->defense_date}}</p>
                                <p>
                                    {!! Form::open(['action' => ['ThesesController@update', $thesis->id], 'method' => 'PUT']) !!}
                                        <div class="form-group">
                                            {{Form::label('thesis_status', 'Staatus')}}
                                            {{Form::select('thesis_status', $statusList, $thesis->status->id)}}
                                            {{Form::submit('Muuda', ['class' => 'btn btn-primary btn-xs'])}}
                                        </div>
                                    {!! Form::close() !!}
                                </p>
                                <br>
                                <br>
                                <p>
                                    <b>Lõputöö fail: </b>
                                    @foreach ($thesis->fileentry as $fileentry)
                                        <br><br>
                                        <a href="{{route('getentry', $fileentry->filename)}}" class="btn btn-primary btn-xs">Lae alla</a>
                                        {{$fileentry->original_filename}}
                                    @endforeach
                                </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
