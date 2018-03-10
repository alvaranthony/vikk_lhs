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
            <div class="panel panel-primary">
                <div class="panel-heading">Kasutajate loend</div>
                <div class="panel-body">
                    {!! Form::open(['action' => ['UserController@index'], 'method' => 'GET']) !!}
                        <div class="form-group pull-right">
                            <div class="form-group">
                                {{Form::label('last_name', 'Otsi perenime põhjal')}}
                                {{Form::text('last_name', '', ['class' => 'form-control'])}}
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
                    <h4>Kasutajaid kokku: {{count($users_all)}}</h4>
                    <table class="table table-dark">
                        <thead>
                            <th></th>
                            <th>Eesnimi</th>
                            <th>Perekonnanimi</th>
                            <th>Liitus</th>
                            <th></th>
                        </thead>
                        @foreach ($users_all as $user)
                            <tbody>
                                <th>{{$loop->iteration}}</th>
                                <th>{{$user->first_name}}</th>
                                <th>{{$user->last_name}}</th>
                                <th>{{$user->created_at}}</th>
                                <th><a href="/users/{{$user->id}}" class="material-icons pull-right">open_in_new</a></th>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
