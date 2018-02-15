@extends('layouts.app')

@section('content')
<div class="container container-custom">
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
                    
                
                    {!! Form::open(['action' => 'ThesesController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('name', 'Lõputöö nimi')}}
                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nimetus/täielik sõnastus'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('defense_date', 'Kaitsmise kuupäev')}}
                            {{Form::text('defense_date', '', ['id' => 'datepicker', 'class' => 'form-control datepicker-cls', 'placeholder' => 'yyyy-mm-dd'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('thesis_instructor', 'Vali juhendaja')}}
                            {{Form::select('thesis_instructor', $usersList, null, ['class' => 'form-control', 'placeholder' => 'Vali'])}}
                        </div>
                        <div class="btn-toolbar">
                            {{Form::submit('Sisesta', ['class' => 'btn btn-primary'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
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
                        <p>Fail peab olema .pdf formaadis!</p>
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
