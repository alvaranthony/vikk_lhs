@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Registreeri EUCIP eksamitele</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-warning alert-block">
                        <strong>Eksamitele saavad registreeruda ainult IT-tugiisikud, Noorem tarkvaraarendajad ning IT-süsteemide spetsialistid</strong>
                    </div>
                    @if ($user->exam_lang === NULL)
                        {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'PUT']) !!}
                            <div class="alert alert-info alert-block">
                                <strong>Eksamitele registreerumiseks on vajalik esmalt eksami keel määrata</strong>
                            </div>
                            <div class="form-group">
                                {{Form::label('exam_lang', 'Vali eksamikeel')}}
                                {{Form::select('exam_lang', $exam_lang_list, null, ['class' => 'form-control', 'placeholder' => 'Pole valitud'])}}
                            </div>
                            <div class="btn-toolbar">
                                {{Form::submit('Määra eksami keel', ['class' => 'btn btn-primary'])}}
                            </div>
                        {!! Form::close() !!}
                    @endif
                    <br>
                    @if ($user->group === NULL)
                        {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'PUT']) !!}
                            <div class="alert alert-info alert-block">
                                <strong>Eksamitele registreerumiseks on vajalik esmalt õppegrupp määrata</strong>
                            </div>
                            <div class="form-group">
                                {{Form::label('study_group', 'Õppegrupp')}}
                                {{Form::select('study_group', $groupsList, null, ['class' => 'form-control', 'placeholder' => 'Vali'])}}
                            </div>
                            <div class="btn-toolbar">
                                {{Form::submit('Määra õppegrupp', ['class' => 'btn btn-primary'])}}
                            </div>
                        {!! Form::close() !!}
                    @endif
                    @if ($user->exam_lang != NULL && $user->group != NULL)
                        @if($isMatch_IS || $isMatch_ISK || $isMatch_TA || $isMatch_TAK || $isMatch_ITT)
                            {!! Form::open(['action' => 'ExamController@store', 'enctype' => 'multipart/form-data', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('exam_type', 'Vali sooritatavad eksamid - maksimaalselt 3')}}
                                    {{Form::select('exam_type[]', $exam_type_list, null, ['class' => 'form-control', 'multiple' => 'multiple', 'size' => '3'])}}
                                </div>
                                <div class="btn-toolbar">
                                    {{Form::submit('Registreeri eksamitele', ['class' => 'btn btn-primary'])}}
                                </div>
                            {!! Form::close() !!}
                        @else 
                            <div class="alert alert-danger alert-block">
                                <strong>Teie õppegrupp ei saa eksamitele registreeruda</strong>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
