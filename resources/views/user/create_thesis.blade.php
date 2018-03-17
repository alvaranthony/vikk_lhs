@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Sisesta lõputöö</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['action' => 'ThesesController@store', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
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
                        <div class="form-group">
                            {{Form::label('study_group', 'Õppegrupp')}}
                            {{Form::select('study_group', $groupsList, null, ['class' => 'form-control', 'placeholder' => 'Vali'])}}
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            {{Form::label('thesis_file', 'Lõputöö fail')}}
                            {{Form::file('thesis_file', '', ['class' => 'form-control'])}}
                        </div>
                        <p>Fail peab olema .pdf või .docx formaadis!</p>
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
