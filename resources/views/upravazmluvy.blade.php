@extends('layouts.app')

@section('content')

<div class="card-header">Zmena poistnej zmluvy {{$zmluva->name}}</div>

    <div class="card-body">
        <div class="col">
            Nový poistný produkt
            <form action="zmluva" method="post">
                <select>
                    @foreach ($produkty as $produkt)
                        <option value="{{$produkt->id}}">{{$produkt->nazov}}</option>
                    @endforeach
                </select><br>
                <input type="submit" value="Vytvoriť žiadosť">
            </form>
        </div>
    </div>

</div>

@endsection
