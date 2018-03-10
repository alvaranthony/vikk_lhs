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
                <div class="panel-heading">Õppegruppide loend</div>
                <div class="panel-body">
                    {!! Form::open(['action' => ['GroupController@store'], 'method' => 'POST']) !!}
                        <div class="form-group pull-left">
                            <div class="form-group">
                                {{Form::label('new_group_name', 'Lisa uus õppegrupp')}}
                                {{Form::text('new_group_name', '', ['class' => 'form-control'])}}
                            </div>
                            {{Form::submit('Lisa', ['class' => 'btn btn-default btn-xs'])}}
                        </div>
                    {!! Form::close() !!}
                    {!! Form::open(['action' => ['GroupController@index'], 'method' => 'GET']) !!}
                        <div class="form-group pull-right">
                            <div class="form-group">
                                {{Form::label('group_name', 'Otsi grupi nimetuse põhjal')}}
                                {{Form::text('group_name', '', ['class' => 'form-control'])}}
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
                    @if (count($groups_all) > 0)
                        <h4>Õppegruppe kokku: {{count($groups_all)}}</h4>
                        <table class="table table-dark">
                            <thead>
                                <th></th>
                                <th>Õppegrupi nimetus</th>
                            </thead>
                            @foreach ($groups_all as $group)
                                <tbody>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$group->name}}</th>
                                </tbody>
                            @endforeach
                        </table>
                    @else
                        <h4 style="color:red;">Õppegruppide andmed puuduvad!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
