@extends('layouts.app')

@section('content')

<div class="card-header">Zmena poistnej zmluvy</div>

<div class="card-body p-0">
    <div class="col">
    @foreach ($zmluvy as $zmluva)
        <div class="row border-bottom p-4">
            <div class="col">
                <div class="row">
                    <h1>{{ $zmluva->name}}</h1><br>
                </div>
                <div class="row">
                    <a class="btn btn-primary" href="/zmluva/{{$zmluva->id}}/edit">ZMENIŤ</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>


@endsection
