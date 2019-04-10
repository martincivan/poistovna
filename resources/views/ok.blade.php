@extends('layouts.app')

@section('content')

<div class="card-header">{{$akcia}}</div>

<div class="card-body">
    <div class="col">
        <div class="row">
            {{$sprava}}
        </div>
        <div class="row">
            <a class="btn btn-primary" href="{{$redirect}}">OK</a>
        </div>
    </div>
</div>


@endsection
