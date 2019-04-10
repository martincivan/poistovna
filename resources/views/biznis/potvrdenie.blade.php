@extends('layouts.app')

@section('content')

<div class="card-header">Vybavenie žiadostí (počet nevybavených: {{count($zmluvy)}})</div>

<div class="card-body p-0">
    <div class="col">
        @foreach ($zmluvy as $z)
            <div class="row border-bottom p-4">
                <div class="col">
                    <div class="row">
                            <h3>{{$z->name}}</h3><br>
                    </div>
                    <div class="row">
                        <p>
                            Zákazník: {{$z->zakaznik->meno}}
                        </p>
                    </div>
                    <div class="row">
                        <p>
                            Produkt: {{$z->produkt->nazov}}
                        </p>
                    </div>
                    <div class="row">
                        <p>
                            Začiatok platnosti: {{$z->zaciatok}}
                        </p>
                    </div>
                    <div class="row">
                            <p>
                                Koniec platnosti: {{$z->koniec}}
                            </p>
                        </div>
                    <div class="row">
                        <a class="btn btn-primary mr-4" href="/zmluva/{{$z->id}}/potvrd">Potvrdiť</a><br>
                        <a class="btn btn-secondary" href="/zmluva/{{$z->id}}/zdovodnenie">Zamietnuť</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
