@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
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
                        {{$thesis->author->first()->first_name}}
                        {{$thesis->author->first()->last_name}}
                    </p>
                    <p><b>Kaitsmise kuupäev: </b>{{$thesis->defense_date}}</p>
                    <p>
                        <b>Juhendaja: </b>
                        {{$thesis->instructor->first()->first_name}}
                        {{$thesis->instructor->first()->last_name}}
                    </p>
                    <p><b>Õppegrupp: </b>{{$thesis->group->name}}</p>
                    @if ($current_user->hasRole('Juhendaja'))
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
                    @else
                        <p><b>Staatus: </b>{{$thesis->status->name}}</p>
                    @endif
                    @if (count($thesis->fileentry) > 0)
                        <p>
                        <b>Lõputöö fail: </b>
                        @foreach ($thesis->fileentry as $fileentry)
                            <br><br>
                            <a href="{{route('getentry', $fileentry->filename)}}" class="material-icons">file_download</a>
                            {{$fileentry->original_filename}}
                        @endforeach
                        </p>
                    @endif
                </div>
                @if(count($thesis->comment) > 0)
                    <hr>
                    <div class="panel-body">
                        <p><b>Kommentaarid</b></p>
                        <br>
                        @foreach ($thesis->comment as $comment)
                            <p><b>{{$comment->user->first_name}} {{$comment->user->last_name}}: </b></p>
                            <p class="comment-custom">{{$comment->comment}}</p>
                            <br>
                        @endforeach
                    </div>
                    <br>
                @endif
                <div class="panel-body">
                    {!! Form::open(['action' => 'CommentController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::textarea('comment', '', ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Kuni 500 tähemärki'])}}
                        </div>
                        <div class="btn-toolbar">
                            {!! Form::hidden('thesisId', $thesis->id) !!}
                            {{Form::submit('Lisa kommentaar', ['class' => 'btn btn-primary btn-xs'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
