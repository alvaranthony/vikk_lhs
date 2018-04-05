@extends('layouts.app')

@section('content')

<script>
    function confirmMessage(message)
    {
    var x = confirm("Kas olete kindel? " + message);
    if (x)
        return true;
    else
        return false;
    }
</script>

<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">{{$thesis->name}}</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($current_user->hasRole('Komisjoni esimees'))
                        <div class="pull-right">
                            {!!Form::open(['action' => ['ThesesController@update', $thesis->id], 'method' => 'PUT', 'onsubmit' => 'return confirmMessage("Soovite töö staatust muuta.")'])!!}
                                {{Form::label($committee_actions ? 'Määra töö kaitstuks' : 'Eemalda töö kaitstud tööde hulgast')}}
                                {{Form::submit('check_circle', ['class' => $committee_actions ? 'btn btn-primary btn-xs material-icons': 'btn btn-danger btn-xs material-icons'])}}
                            {!!Form::close()!!}
                        </div>
                    @endif
                    <p><b>Teema: </b>{{$thesis->name}}</p>
                    @if(!$thesis->author->isEmpty())
                        <p>
                            <b>Töö autor: </b>
                            {{$thesis->author->first()->first_name}}
                            {{$thesis->author->first()->last_name}}
                        </p>
                    @endif
                    <p><b>Kaitsmise kuupäev: </b>{{$thesis->defense_date}}</p>
                    @if(!$thesis->instructor->isEmpty())
                        <p>
                            <b>Juhendaja: </b>
                            {{$thesis->instructor->first()->first_name}}
                            {{$thesis->instructor->first()->last_name}}
                        </p>
                    @endif
                    <p><b>Õppegrupp: </b>{{$thesis->group->name}}</p>
                    @if ($isInstructor)
                        <p>
                            {!! Form::open(['action' => ['ThesesController@update', $thesis->id], 'method' => 'PUT', 'onsubmit' => 'return confirmMessage("Soovite töö staatust muuta.")']) !!}
                                <div class="form-group">
                                    {{Form::label('thesis_status', 'Muuda staatust')}}
                                    {{Form::select('thesis_status', $statusList, $thesis->status->id)}}
                                    {{Form::submit('Muuda', ['class' => 'btn btn-primary btn-xs'])}}
                                </div>
                            {!! Form::close() !!}
                        </p>
                    @else
                        <p><b>Staatus: </b>{{$thesis->status->name}}</p>
                    @endif
                    @if ($hasReviewer)
                        <p>
                            <b>Retsensent: </b>
                            {{$thesis->reviewer->first()->first_name}}
                            {{$thesis->reviewer->first()->last_name}}
                        </p>
                        <p>
                            @if ($thesis->reviewer_grade != NULL)
                                <b>Retsensendi hinne: </b>
                                {{$thesis->reviewer_grade->grade}}
                            @endif
                        </p>
                            @if ($thesis->reviewer_assessment != NULL)
                                <p><b>Retsensendi hinnang</b></p>
                                <p class="comment-custom">{{$thesis->reviewer_assessment->assessment}}</p>
                            @endif
                        <br>
                        <br>
                    @endif
                    @if ($isReviewer)
                        <p><b>{{$reviewer_grade_add_update}} retsensendi hinne: </b></p>
                        {!! Form::open(['action' => ['ThesesController@update', $thesis->id], 'method' => 'PUT', 'onsubmit' => 'return confirmMessage("Soovite hinnet lisada/uuendada.")']) !!}
                            <div class="form-group">
                                {{Form::label('reviewer_grade', 'Hinne')}}
                                {{Form::select('reviewer_grade', $gradesList, null, ['placeholder' => $reviewer_grade_add_update])}}
                                {{Form::submit($reviewer_grade_add_update, ['class' => 'btn btn-primary btn-xs'])}}
                            </div>
                        {!! Form::close() !!}
                        
                        @if ($thesis->reviewer_assessment === NULL)
                            <div class="panel-body">
                                {!! Form::open(['action' => 'ReviewerAssessmentController@store', 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {{Form::textarea('assessment', '', ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Kuni 750 tähemärki'])}}
                                    </div>
                                    <div class="btn-toolbar">
                                        {!! Form::hidden('thesisId', $thesis->id) !!}
                                        {{Form::submit('Lisa retsensendi hinnang', ['class' => 'btn btn-primary btn-xs'])}}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        @else
                            <p>
                                {!!Form::open(['action' => ['ReviewerAssessmentController@destroy', $thesis->reviewer_assessment_id], 'method' => 'POST', 'onsubmit' => 'return confirmMessage("Soovite hinnangu eemaldada.")'])!!}
                                    {!! Form::hidden('thesisId', $thesis->id) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Eemalda hinnang', ['class' => 'btn btn-danger btn-xs'])}}
                                {!!Form::close()!!}
                            </p>
                        @endif
                        
                        @if (count($thesis->fileentry->where('mime', '=', 'application/pdf')) > 0)
                            <p>
                                <br>
                                <br>
                                <b>Retsenseeritava lõputöö fail: </b>
                                <br>
                                <a href="{{route('getentry', $thesis->fileentry->where('mime', '=', 'application/pdf')->last()->filename)}}" class="material-icons">
                                    file_download
                                </a>
                                {{$thesis->fileentry->where('mime', '=', 'application/pdf')->last()->original_filename}}
                                <br><br>
                            </p>
                        @endif
                    @endif
                    @if ($current_user->hasRole('Administraator'))
                        @if ($thesis->status_id === 3)
                            {!! Form::open(['action' => ['ThesesController@update', $thesis->id], 'method' => 'PUT', 'onsubmit' => 'return confirmMessage("Soovite retsensenti lisada/muuta.")']) !!}
                                <div class="form-group">
                                    {{Form::label('thesis_reviewer', $reviewer_add_update.' retsensent')}}
                                    {{Form::select('thesis_reviewer', $usersList, null, ['placeholder' => $reviewer_add_update])}}
                                    {{Form::submit($reviewer_add_update, ['class' => 'btn btn-primary btn-xs'])}}
                                </div>
                            {!! Form::close() !!}
                        @endif
                    @endif
                    <br>
                    <br>
                    @if (count($thesis->fileentry) > 0)
                        <p>
                        <b>Lõputöö fail(id): </b>
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
