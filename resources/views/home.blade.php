@extends('layouts.app')

@section('content')

<div class="card-header">Zmena poistnej zmluvy</div>

<div class="card-body">
    <div class="col">
    @foreach ($zmluvy as $zmluva)
        <div class="row border-bottom">
            <h1>{{ $zmluva->name}}</h1><br>
            <a href="/zmluva/{{$zmluva->id}}/edit">ZMENIŤ</a>
        </div>
    @endforeach
    </div>
</div>


@endsection
