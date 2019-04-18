@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrácia</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Meno</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adresa" class="col-md-4 col-form-label text-md-right">Adresa</label>

                            <div class="col-md-6">
                                <input id="adresa" type="text" class="form-control{{ $errors->has('adresa') ? ' is-invalid' : '' }}" name="adresa" value="{{ old('adresa') }}" required autofocus>

                                @if ($errors->has('adresa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('adresa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="datum_narodenia" class="col-md-4 col-form-label text-md-right">Dátum narodenia</label>

                            <div class="col-md-6">
                                <input id="datum_narodenia" type="date" class="form-control{{ $errors->has('datum_narodenia') ? ' is-invalid' : '' }}" name="datum_narodenia" value="{{ old('datum_narodenia') }}" required autofocus>

                                @if ($errors->has('datum_narodenia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('datum_narodenia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="komunikacia" class="col-md-4 col-form-label text-md-right">Spôsob komunikácie</label>

                            <div class="col-md-6">
                                <select id="komunikacia" type="text" class="form-control{{ $errors->has('komunikacia') ? ' is-invalid' : '' }}" name="komunikacia" value="{{ old('komunikacia') }}" required autofocus>
                                    <option value=1>E-mailom</option>
                                    <option value=2>Poštou</option>
                                </select>

                                @if ($errors->has('komunikacia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('komunikacia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Heslo</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Potvrdenie hesla</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrovať
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
