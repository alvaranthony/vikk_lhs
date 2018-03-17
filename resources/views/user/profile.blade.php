@extends('layouts.app')

@section('content')

<div class="container container-custom">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Minu profiil</div>
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
                    <p><b>Liitumiskuupäev: </b>{{$user->created_at}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
