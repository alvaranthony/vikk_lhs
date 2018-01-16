@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sisesta lõputöö</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                
                    {!! Form::open(['action' => 'InternshipController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('company_name', 'Ettevõtte nimi')}}
                            {{Form::text('company_name', '', ['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('start_date', 'Alguskuupäev')}}
                            {{Form::text('start_date', '', ['id' => 'datepicker', 'class' => 'form-control datepicker-cls', 'placeholder' => 'yyyy-mm-dd'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('end_date', 'Lõppkuupäev')}}
                            {{Form::text('end_date', '', ['id' => 'datepicker1', 'class' => 'form-control datepicker-cls', 'placeholder' => 'yyyy-mm-dd'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('duration', 'Maht akadeemilistes tundides')}}
                            {{Form::text('duration', '', ['class' => 'form-control'])}}
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
