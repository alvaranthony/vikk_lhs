@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
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
                                <th>Õppegrupp</th>
                                <th>Lõputöö fail</th>
                                <th></th>
                            </thead>
                            @foreach($theses as $thesis)
                            <tbody>
                                <th>{{$loop->iteration}}</th>
                                <th>
                                    {{$thesis->author->first()->first_name}}
                                    {{$thesis->author->first()->last_name}}
                                </th>
                                <th>
                                    {{$thesis->name}}
                                    @if(count($thesis->comment) > 0)
                                        <p class="material-icons">comment</p>
                                    @endif
                                </th>
                                <th>{{$thesis->defense_date}}</th>
                                <th>{{$thesis->status->name}}</th>
                                <th>{{$thesis->group->name}}</th>
                                <th>
                                    @if (count($thesis->fileentry) > 0)
                                        @foreach ($thesis->fileentry as $fileentry)
                                            <a href="{{route('getentry', $fileentry->filename)}}" class="material-icons">file_download</a>
                                            {{$fileentry->original_filename}}
                                        @endforeach
                                    @else
                                        Pole lisatud!
                                    @endif
                                </th>
                                <th><a href="/theses/{{$thesis->id}}" class="material-icons">open_in_new</a></th>
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