@extends('layouts.app')

@section('content')

<div class="card-header">Zmena poistnej zmluvy</div>

<div class="card-body p-0">
    <div class="col">
    @foreach ($zmluvy as $zmluva)
        <div class="row border-bottom p-4
            @switch($zmluva->stav)
                @case(1) bg-warning @break
                @case(2) bg-success @break
                @case(3) bg-danger @break
                @default
            @endswitch">
            <div class="col">
                <div class="row">
                    <h1>{{ $zmluva->name}}</h1><br>
                </div>
                @switch($zmluva->stav)
                    @case(2)
                    <div class="row">
                        <p>Táto zmluva je platná</p>
                    </div>
                    <div class="row">
                        <a class="btn btn-primary" href="/zmluva/{{$zmluva->id}}/edit">ZMENIŤ</a>
                    </div>
                    @break
                    @case(1)
                    <div class="row">
                        <p>Táto žiadosť zatiaľ nebola spracovaná</p>
                    </div>
                    <div class="row">
                        <a class="btn btn-primary" href="/zmluva/{{$zmluva->id}}/edit">ZMENIŤ</a>
                    </div>
                    @break
                    @case(3)
                    <div class="row">
                        <p>Táto zmluva bola zamietnutá</p>
                    </div>
                    <div class="row">
                        <a class="btn btn-secondary" href="/zmluva/{{$zmluva->id}}/edit">ZMENIŤ</a>
                    </div>
                    @break
                    @default
                @endswitch
            </div>
        </div>
    @endforeach
    </div>
</div>


@endsection
