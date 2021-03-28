@extends('layouts.app')

@section('styles')
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <!-- Esri Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">
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
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre del establecimiento" value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Categoría</label>
                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                        <option value="" selected disabled>--Seleccione--</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="main_image">Imagen Principal</label>
                    <input name="main_image" type="file" class="form-control @error('main_image') is-invalid @enderror" value="{{ old('main_image') }}">

                    @error('main_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </fieldset>


            <fieldset class="border p-4">
                <legend class="text-primary">
                    Ubicación
                </legend>
                <div class="form-group">
                    <label for="address-search">Dirección</label>
                    <input name="address-search" id="address-search" type="text" class="form-control" placeholder="Dirección del establecimiento">
                </div>
                <p class="text-secondary mt-3 mb-3 text-justify">
                    El asistente colocará una dirección estimada. Por favor, mueva el Marcador hacia el lugar exacto de su establecimiento.
                </p>

                <div class="form-group">
                    <div id="map" style="height: 400px;">
                    </div>
                </div>

                <p class="information">Por favor, confirme que los siguientes campos son correctos:</p>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección" value="{{ old('address') }}">

                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="town">Población</label>
                    <input type="text" name="town" id="town" class="form-control @error('town') is-invalid @enderror" placeholder="Población" value="{{ old('town') }}">

                    @error('town')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <input type="hidden" id="lat" name="lat" value={{ old('lat') }}>
                <input type="hidden" id="lng" name="lng" value={{ old('lng') }}>
            </fieldset>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Leaflet -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="" defer></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.5.3/dist/esri-leaflet.js" integrity="sha512-K0Vddb4QdnVOAuPJBHkgrua+/A9Moyv8AQEWi0xndQ+fqbRfAFd47z4A9u1AW/spLO0gEaiE1z98PK1gl5mC5Q==" crossorigin="" defer></script>
    <!-- Esri Leaflet Geocoder -->
    <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js" integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA==" crossorigin="" defer></script>
@endsection
