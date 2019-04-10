@extends('layouts.app')

@section('content')

<div class="card-header">Zmena poistnej zmluvy {{$zmluva->name}}</div>

    <div class="card-body">
        <div class="col">
            Nový poistný produkt
            <form action="zmluva" method="post">
                <select name="produkt" class="form-control" required>
                    @foreach ($produkty as $produkt)
                        <option value="{{$produkt}}">{{$produkt->nazov}}</option>
                    @endforeach
                </select><br>
                <input class="btn btn-primary" type="submit" value="Vytvoriť žiadosť">
            </form>
        </div>
    </div>

</div>

@endsection
