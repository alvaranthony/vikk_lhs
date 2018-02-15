@extends('layouts.app')


@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                                <div class="panel-heading">Minu poolt juhendatavate lõputööde andmed</div>
                
                                <div class="panel-body">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                    @if (count($theses) > 0)
                            <table class="table table-hover table-dark" style="margin-top: 20px;">
                                <thead>
                                    <th></th>
                                    <th>Õpilane</th>
                                    <th>Lõputöö nimi</th>
                                    <th>Kaitsmise kuupäev</th>
                                    <th>Staatus</th>
                                    <th>Lõputöö fail</th>
                                    <th></th>
                                </thead>
                                @foreach($theses as $thesis)
                                <tbody>
                                    <th>{{$loop->iteration}}</th>
                                    <th>
                                        @foreach($thesis->user as $user)
                                            @if($user->pivot->role_id === 1)
                                                @foreach($users_all as $student)
                                                    @if($student->id === $user->id)
                                                        {{$student->full_name}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </th>
                                    <th>{{$thesis->name}}</th>
                                    <th>{{$thesis->defense_date}}</th>
                                    <th>{{$thesis->status->name}}</th>
                                    <th>
                                        @foreach ($thesis->fileentry as $fileentry)
                                            <a href="{{route('getentry', $fileentry->filename)}}" class="btn btn-primary btn-xs pull-right">Lae alla</a>
                                            {{$fileentry->original_filename}}<br><br>
                                        @endforeach
                                    </th>
                                    <th><a href="/theses/{{$thesis->id}}" class="material-icons">mode_edit</a></th>
                                </tbody>
                                @endforeach
                            </table>
                    @else
                        <h4 style="color:red;">Lõputöö andmed puuduvad!</h4>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection