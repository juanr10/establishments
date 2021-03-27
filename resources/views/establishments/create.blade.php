@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center-mt-4">
            Registrar establecimiento
        </h1>
    </div>

    <div class="mt-5 row justify-content-center">
        <form action="" class="col-md-9 col-xs-12 card card-body">
            <fieldset class="border p-4">
                <legend class="text-primary">
                    Nombre y Categoría
                </legend>
                <div class="form-group">
                    <label for="name">Nombre Establecimiento</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid
                    @enderror" placeholder="Nombre del establecimiento" value={{ old('name') }}>
                </div>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </fieldset>
        </form>
    </div>
@endsection
