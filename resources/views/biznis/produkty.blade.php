@extends('layouts.app')

@section('content')

<div class="card-header">Nový produkt</div>

<div class="card-body">
    <form action="produkt" method="POST">
        @csrf
            Názov produktu<br>
            <input type="text" class="form-control" name="nazov" placeholder="Názov produktu" required><br>
            Cena produktu<br>
            <input name="cena" class="form-control" type="number" step="0.01" placeholder="Cena produktu" required><br>
            Začiatok platnosti<br>
            <input name="zaciatok" class="form-control" type="date" placeholder="Začiatok platnosti" required><br>
            Koniec platnosti<br>
            <input name="koniec" class="form-control" type="date" placeholder="Koniec platnosti" required><br>
            Detailný popis produktu<br>
            <textarea name="popis" class="form-control" placeholder="Detailný popis produktu" required>
            </textarea><br>
        <input class="btn btn-primary" type="submit" value="vytvor">
    </form>
</div>

@endsection
