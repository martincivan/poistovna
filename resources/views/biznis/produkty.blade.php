@extends('layouts.app')

@section('content')

<div class="card-header">Nový produkt</div>

<div class="card-body">
    <form action="produkt" method="POST">
        @csrf
            <input type="text" name="nazov" placeholder="Názov produktu"><br>
            <input name="cena" type="number" step="0.01" placeholder="Cena produktu"><br>
            <input name="zaciatok" type="date" placeholder="Začiatok platnosti"><br>
            <input name="koniec" type="date" placeholder="Koniec platnosti"><br>
            <textarea name="popis" placeholder="Detailný popis produktu">
            </textarea><br>
        <input type="submit" value="vytvor">
    </form>
</div>

@endsection
