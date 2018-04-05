@extends('layouts.app')

@section('content')
<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Kaitsmisele lubatud lõputööde andmed</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    {!! Form::open(['action' => ['ThesesController@committeeTheses'], 'method' => 'GET']) !!}
                        <div class="form-group pull-right">
                            <div class="form-group">
                                {{Form::label('name', 'Otsi teema põhjal')}}
                                {{Form::text('name', '', ['class' => 'form-control'])}}
                            </div>
                            {{Form::submit('Otsi', ['class' => 'btn btn-default btn-xs'])}}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Lõputööde arv: {{count($theses_all)}}</h4>
                    @if (count($theses_all) > 0)
                        <table class="table table-hover table-dark" style="margin-top: 20px;">
                            <thead>
                                <th></th>
                                <th>Õpilane</th>
                                <th>Lõputöö nimi</th>
                                <th>Kaitsmise kuupäev</th>
                                <th>Staatus</th>
                                <th>Õppegrupp</th>
                                <th>Juhendaja</th>
                                <th>Retsensent</th>
                                <th></th>
                            </thead>
                            @foreach($theses_all as $thesis)
                            <tbody>
                                <th>{{$loop->iteration}}</th>
                                <th>
                                    @if(!$thesis->author->isEmpty())
                                        {{$thesis->author->first()->first_name}}
                                        {{$thesis->author->first()->last_name}}
                                    @else
                                        Puudub!
                                    @endif
                                </th>
                                <th>{{$thesis->name}}</th>
                                <th>{{$thesis->defense_date}}</th>
                                <th>{{$thesis->status->name}}</th>
                                <th>{{$thesis->group->name}}</th>
                                <th>
                                    {{$thesis->instructor->first()->first_name}}
                                    {{$thesis->instructor->first()->last_name}}
                                </th>
                                <th>
                                    @if ($thesis->user()->where('role_id', $reviewer_role_id)->exists())
                                        {{$thesis->reviewer->first()->first_name}}
                                        {{$thesis->reviewer->first()->last_name}}
                                    @else
                                        Pole lisatud!
                                    @endif
                                </th>
                                <th><a href="/theses/{{$thesis->id}}" class="material-icons">open_in_new</a></th>
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
