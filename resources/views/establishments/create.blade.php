@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
@endsection

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
                    Nombre, Categoría e Imagen Principal
                </legend>
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid
                    @enderror" placeholder="Nombre del establecimiento" value={{ old('name') }}>
                </div>

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="category">Categoría</label>
                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                        <option value="" selected disabled>--Seleccione--</option>
                        @foreach ($categories as $category)
                        <option value={{ $category->id }} {{ old('category') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-group">
                    <label for="main_image">Imagen Principal</label>
                    <input name="main_image" type="file" class="form-control @error('main_image') is-invalid
                    @enderror" value={{ old('main_image') }}>
                </div>

                @error('main_image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </fieldset>


            <fieldset class="border p-4">
                <legend class="text-primary">
                    Ubicación
                </legend>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input name="address" type="text" class="form-control" placeholder="Dirección del establecimiento">
                </div>
                <p class="text-secondary mt-3 mb-3 text-justify">
                    El asistente colocará una dirección estimada. Por favor, mueva el Marcador hacia el lugar exacto de su establecimiento.
                </p>

                <div class="form-group">
                    <div id="map" style="height: 400px;">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
@endsection
