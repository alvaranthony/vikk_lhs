@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Muuda praktika andmeid</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['action' => ['InternshipController@update', $internship->id], 'method' => 'PUT']) !!}
                        <div class="form-group">
                            {{Form::label('company_name', 'Ettevõtte nimi')}}
                            {{Form::text('company_name', $internship->company_name, ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('start_date', 'Alguskuupäev')}}
                            {{Form::text('start_date', $internship->start_date, ['id' => 'datepicker', 'class' => 'form-control datepicker-cls', 'placeholder' => 'yyyy-mm-dd'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('end_date', 'Lõppkuupäev')}}
                            {{Form::text('end_date', $internship->end_date, ['id' => 'datepicker1', 'class' => 'form-control datepicker-cls', 'placeholder' => 'yyyy-mm-dd'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('duration', 'Maht akadeemilistes tundides')}}
                            {{Form::text('duration', $internship->duration, ['class' => 'form-control'])}}
                        </div>
                        <div class="btn-toolbar">
                            {{Form::submit('Muuda', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
