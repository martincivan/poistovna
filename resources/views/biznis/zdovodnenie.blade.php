@extends('layouts.app')

@section('content')

<div class="card-header">Zamietnutie žiadosti o zmenu zmluvy</div>

<div class="card-body">
    <div class="col">
        <h3>Zmluva {{$zmluva->name}} - zdôvodnenie zamietnutia</h3>
        <p>Nižšie zadajte dôvod zamietnutia žiadosti</p>
        <form action="/zmluva/{{$zmluva->id}}/zamietni" method="post">
            @csrf
            <textarea name="zdovodnenie" required></textarea><br>
            <input class="btn btn-primary" type="submit" value="Hotovo">
        </form>
    </div>
</div>


@endsection
