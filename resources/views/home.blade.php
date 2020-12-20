@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.message')

            {{-- recibo entonces $images que contiene cada entrada de la tabla imagen en forma de objeto --}}
            @foreach($images as $image)
                @include('includes.image',['image' => $image])
            @endforeach
        {{-- paginacion --}}
        {{-- uso clearfix para limpiar los floats --}}
        <div class="clearfix"></div>
        {{$images->links()}}


        </div>
    </div>
</div>
@endsection

