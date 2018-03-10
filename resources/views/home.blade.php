@extends('layouts.app')

@section('content')

<script>
    function confirmDelete()
    {
    var x = confirm("Kas olete kindel, et soovite andmed kustutada?");
    if (x)
        return true;
    else
        return false;
    }
</script>

<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if ($user->hasRole('Õpilane'))
                <div class="panel panel-primary">
                    <div class="panel-heading">Minu lõputöö andmed</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($theses) > 0)
                            @foreach($theses as $thesis)
                                <table class="table table-hover table-dark" style="margin-top: 20px;">
                                    <thead>
                                        <th>Lõputöö nimi</th>
                                        <th>Kaitsmise kuupäev</th>
                                        <th>Juhendaja</th>
                                        <th>Staatus</th>
                                        <th>Õppegrupp</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <th>
                                            {{$thesis->name}}
                                            @if(count($thesis->comment) > 0)
                                                <p class="material-icons">comment</p>
                                            @endif
                                        </th>
                                        <th>{{$thesis->defense_date}}</th>
                                        <th>
                                            {{$thesis->instructor->first()->first_name}}
                                            {{$thesis->instructor->first()->last_name}}
                                        </th>
                                        <th>{{$thesis->status->name}}</th>
                                        <th>{{$thesis->group->name}}</th>
                                        <th></th>
                                        <th><a href="/theses/{{$thesis->id}}" class="material-icons">open_in_new</a></th>
                                        <th><a href="/theses/{{$thesis->id}}/edit" class="material-icons">mode_edit</a></th>
                                        <th>
                                            {!!Form::open(['action' => ['ThesesController@destroy', $thesis->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => 'return confirmDelete()'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('delete_forever', ['class' => 'material-icons btn btn-danger btn-xs'])}}
                                            {!!Form::close()!!}
                                        </th>
                                    </tbody>
                                </table>
                                @if (count($thesis->fileentry) > 0)
                                    <table class="table table-hover table-dark" style="margin-top: 20px;">
                                        <thead>
                                            <th>Lõputöö fail</th>
                                            <th></th>
                                        </thead>
                                        @foreach ($thesis->fileentry as $fileentry)
                                            <tbody>
                                                <th>{{$fileentry->original_filename}}</th>
                                                <th><a href="{{route('getentry', $fileentry->filename)}}" class="material-icons pull-right">file_download</a></th>
                                            </tbody>
                                        @endforeach
                                    </table>
                                @endif
                            @endforeach
                        @else
                            <h4 style="color:red;">Lõputöö andmed puuduvad!</h4>
                        @endif
                    </div>
                </div>
                <div class="panel panel-primary">
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
                                    <th></th>
                                    <th>Ettevõtte nimi</th>
                                    <th>Alguskuupäev</th>
                                    <th>Lõpukuupäev</th>
                                    <th>Maht akadeemilistes tundides</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                @foreach ($internship as $intern)
                                    <tbody>
                                        <th>{{$loop->iteration}}</th>
                                        <th>{{$intern->company_name}}</th>
                                        <th>{{$intern->start_date}}</th>
                                        <th>{{$intern->end_date}}</th>
                                        <th>{{$intern->duration}}</th>
                                        <th><a href="/internships/{{$intern->id}}/edit" class="material-icons">mode_edit</a></th>
                                        <th>
                                            {!!Form::open(['action' => ['InternshipController@destroy', $intern->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => 'return confirmDelete()'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('delete_forever', ['class' => 'material-icons btn btn-danger btn-xs'])}}
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
            @elseif($user->hasRole('Vaikimisi'))
                <p>Olete vaikimisi rollis</p>
            @endif
        </div>
    </div>
</div>
@endsection
