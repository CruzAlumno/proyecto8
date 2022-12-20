@extends('layouts.master')
{{-- Display Productos --}}
@section('content')
    <article class="row">
        <header>
            <h1>Productos Page</h1>
        </header>
        <div class="col-xs-6 col-sm-4 col-md-3">
        @foreach($array_productos as $producto)
            <a href="{{ url('/productos/show/' . $producto['id']) }}"><h4 style="min-height:45px;margin:5px 0 10px 0">{{ $producto['titulo'] }}</h4></a>
        @endforeach
        </div>
        <a class="btn btn-outline-info" href="{{ action('App\Http\Controllers\ProductosController@getCreate') }}">Create Post</a>
    </article>
@endsection
