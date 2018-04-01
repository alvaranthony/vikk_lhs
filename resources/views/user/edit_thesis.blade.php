@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Muuda lõputöö andmeid</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['action' => ['ThesesController@update', $thesis->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{Form::label('name', 'Lõputöö nimi')}}
                            {{Form::text('name', $thesis->name, ['class' => 'form-control', 'placeholder' => 'Nimetus/täielik sõnastus'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('defense_date', 'Kaitsmise kuupäev')}}
                            {{Form::text('defense_date', $thesis->defense_date, ['id' => 'datepicker', 'class' => 'form-control datepicker-cls', 'placeholder' => 'yyyy-mm-dd'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('thesis_instructor', 'Muuda juhendajat')}}
                            {{Form::select('thesis_instructor', $usersList, $instructor_id, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('study_group', 'Muuda õppegruppi')}}
                            {{Form::select('study_group_id', $groupsList, $thesis->group->id, ['class' => 'form-control'])}}
                        </div>
                        <div class="btn-toolbar">
                            {{Form::submit('Muuda', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Lae üles lõputöö fail</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['action' => 'FileEntryController@store', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('thesis_file', 'Lõputöö fail')}}
                            {{Form::file('thesis_file', '', ['class' => 'form-control'])}}
                        </div>
                        <p>Fail peab olema .pdf või .docx formaadis!</p>
                        <div class="btn-toolbar">
                            {{Form::submit('Lae üles', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
