@extends('layouts.app')

@section('content')

<div class="card-header">Zmena poistnej zmluvy {{$zmluva->name}}</div>

    <div class="card-body">
        <div class="col">
            <div class="row">
                <h3>Aktuálna zmluva: {{$zmluva->name}}</h3>
            </div>
            <div class="row">
                Platnosť: {{$zmluva->zaciatok}} až {{$zmluva->koniec}}
            </div>
            Nový poistný produkt
            <form action="/zmluva" method="POST">
                @csrf
                <select name="produkt_id" class="form-control" required>
                    @foreach ($produkty as $produkt)
                        <option value="{{$produkt->id}}">{{$produkt->nazov}}</option>
                    @endforeach
                </select><br>
                <input name="predchadzajuca_zmluva" type="hidden" value="{{$zmluva->id}}">
                Od:
                <input class="form-control" name="zaciatok" type="date" value="{{$zmluva->zaciatok}}">
                Do:
                <input class="form-control" name="koniec" type="date" value="{{$zmluva->koniec}}">
                <input class="btn btn-primary" type="submit" value="Vytvoriť žiadosť">
            </form>
        </div>
    </div>

</div>

@endsection
