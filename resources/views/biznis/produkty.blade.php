@extends('layouts.app')

@section('content')
    <h1>Novy produkt</h1>
<form action="produkt" method="POST">
    @csrf
        <input type="text" name="nazov">
        <input name="cena" type="number" step="0.01">
        <input name="zaciatok" type="date">
        <input name="koniec" type="date">
        <textarea name="popis">
        </textarea>
    <input type="submit" value="vytvor">
</form>
@endsection
