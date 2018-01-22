@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Muuda lõputöö andmeid</div>

                <div class="panel-body">
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
                            {{Form::label('instructor_first_name', 'Juhendaja eesnimi')}}
                            {{Form::text('instructor_first_name', $thesis->instructor_first_name, ['class' => 'form-control', 'placeholder' => 'Eesnimi'])}}
                            {{Form::label('instructor_last_name', 'Juhendaja perenimi')}}
                            {{Form::text('instructor_last_name', $thesis->instructor_last_name, ['class' => 'form-control', 'placeholder' => 'Perenimi'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('reviewer_first_name', 'Retsensendi eesnimi')}}
                            {{Form::text('reviewer_first_name', $thesis->reviewer_first_name, ['class' => 'form-control', 'placeholder' => 'Eesnimi'])}}
                            {{Form::label('reviewer_last_name', 'Retsensendi perenimi')}}
                            {{Form::text('reviewer_last_name', $thesis->reviewer_last_name, ['class' => 'form-control', 'placeholder' => 'Perenimi'])}}
                        </div>
                        <div class="btn-toolbar">
                            {{Form::submit('Sisesta', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
