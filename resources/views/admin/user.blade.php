@extends('layouts.app')

@section('content')

<script>
    function confirmDelete()
    {
    var x = confirm("Kas olete kindel, et soovite antud kasutaja kustutada? Seda toimingut ei saa tagasi võtta!");
    if (x)
        return true;
    else
        return false;
    }
    function confirmRole()
    {
    var x = confirm("Kas olete kindel, et soovite antud kasutajale vastava rolli lisada?");
    if (x)
        return true;
    else
        return false;
    }
</script>

<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">{{$user->first_name}} {{$user->last_name}}</div>
                <div class="panel-body">
                    @include('messages.flash-message')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p><b>Eesnimi: </b>{{$user->first_name}}</p>
                    <p><b>Perekonnanimi: </b>{{$user->last_name}}</p>
                    <p><b>E-posti aadress: </b>{{$user->email}}</p>
                    <p><b>Isikukood: </b>{{$user->id_code}}</p>
                    <p><b>Telefoni number: </b>{{$user->phone_number}}</p>
                    <hr>
                    <p>
                        <b>Olemasolevad rollid: </b>
                        @foreach($user_roles as $role)
                            {{$role->name}}
                        @endforeach
                    </p>
                    @if (!$user->hasRole('Õpilane'))
                        <p>
                            {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'PUT', 'onsubmit' => 'return confirmRole()']) !!}
                                {{Form::label('user_role', 'Määra roll')}}
                                {{Form::select('user_role', $rolesList, null)}}
                                {{Form::submit('Määra', ['class' => 'btn btn-primary btn-xs'])}}
                            {!! Form::close() !!}
                        </p>
                    @endif
                    <hr>
                    @if ($user->id != Auth::user()->id)
                        <div>
                            {!!Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST', 'class' => 'pull-right', 'onsubmit' => 'return confirmDelete()'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Kustuta kasutaja', ['class' => 'btn btn-danger btn-md'])}}
                            {!!Form::close()!!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
