@extends('layouts.master')
{{-- Display Show --}}
@section('content')
    <article class="row">
        <header>
            <h1>Show Page {{ $producto['titulo'] }}</h1>
        </header>
        <ul style="margin-left: 15px;">
            @if($producto['status_active'] == '1')
            <li>Post Activo</li>
            @else
            <li>Post Inactivo</li>
            @endif
            <li>Post ID: {{ $producto['id'] }}</li>
            <li>Titulo: {{ $producto['titulo'] }}</li>
            <li>Descripcion: {{ $producto['descripcion'] }}</li>
            <li>Id Vehiculo (Remplazar Plazas): {{ $producto['vehiculo_id'] }}</li>
            <li>Fecha del Viaje: {{ $producto['fecha_inicio_viaje'] }}</li>
            <li>Hora del Viaje: {{ $producto['hora_inicio_viaje'] }}</li>
            <li>Inicio de la Ruta: {{ $producto['inicio_ruta'] }}</li>
            <li>Destino de la Ruta: {{ $producto['destino_ruta'] }}</li>
            <li>Admiten Desvios: {{ $producto['allow_desvios'] }}</li>
            <li>Precio por Persona: {{ $producto['precio'] }}</li>
            <li>Hora de llegada Estimada: {{ $producto['estimacion_llegada'] }}</li>
            <li>Distancia a Recorrer: {{ $producto['distancia'] }}</li>
        </ul>
        <a class="btn btn-warning" href="{{ url('/productos/edit/' . $producto['id'] ) }}">Editar Post</a>
        <a class="btn btn-outline-info" href="{{ action('App\Http\Controllers\ProductosController@getIndex') }}">Volver al listado</a>
    </article>
@endsection
