@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Minu lõputöö andmed</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                @if (!empty($thesis))
                    <table class="table table-hover table-dark" style="margin-top: 20px;">
                        <thead>
                            <th>Lõputöö nimi</th>
                            <th>Kaitsmise kuupäev</th>
                            <th>Juhendaja nimi</th>
                            <th>Retsensendi nimi</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            <th>{{$thesis->name}}</th>
                            <th>{{$thesis->defense_date}}</th>
                            <th>{{$thesis->instructor_first_name}} {{$thesis->instructor_last_name}}</th>
                            <th>{{$thesis->reviewer_first_name}} {{$thesis->reviewer_last_name}}</th>
                            <th><a href="/theses/{{$thesis->id}}/edit" class="btn btn-default btn-xs pull-right">Muuda</a></th>
                            <th>
                                {!!Form::open(['action' => ['ThesesController@destroy', $thesis->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('X', ['class' => 'btn btn-danger btn-xs'])}}
                                {!!Form::close()!!}
                            </th>
                        </tbody>
                    </table>
                @else
                    <h4 style="color:red;">Lõputöö andmeid pole sisestatud!</h4>
                @endif
                @if (!empty($fileentry))
                    <table class="table table-hover table-dark" style="margin-top: 20px;">
                        <thead>
                            <th>Lõputöö fail</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <th>{{$fileentry->original_filename}}</th>
                            <th><a href="{{route('getentry', $fileentry->filename)}}" class="btn btn-default btn-xs pull-right">Lae alla</th>
                        </tbody>
                    </table>
                @endif
                </div>
                </div>
                
                <div class="panel panel-default">
                <div class="panel-heading">Minu praktika andmed</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                @if (count($internship) > 0)
                    <table class="table table-hover table-dark" style="margin-top: 20px;">
                        <thead>
                            <th>Ettevõtte nimi</th>
                            <th>Alguskuupäev</th>
                            <th>Lõpukuupäev</th>
                            <th>Maht akadeemilistes tundides</th>
                            <th></th>
                            <th></th>
                        </thead>
                        @foreach ($internship as $intern)
                            <tbody>
                                <th>{{$intern->company_name}}</th>
                                <th>{{$intern->start_date}}</th>
                                <th>{{$intern->end_date}}</th>
                                <th>{{$intern->duration}}</th>
                                <th><a href="/internships/{{$intern->id}}/edit" class="btn btn-default btn-xs pull-right">Muuda</a></th>
                                <th>
                                    {!!Form::open(['action' => ['InternshipController@destroy', $intern->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('X', ['class' => 'btn btn-danger btn-xs'])}}
                                    {!!Form::close()!!}
                                </th>
                            </tbody>
                        @endforeach
                    </table>
                @else
                    <h4 style="color:red;">Praktika andmeid pole sisestatud</4>
                @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
