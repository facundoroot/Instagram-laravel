@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="profile-user">

                @if($user->image)
                        <div class="container-avatar"><img src="{{url('/user/avatar/'.$user->image)}}" class="avatar"></div>
                @endif
 
                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                </div>
            </div>

            {{-- limpio los floats --}}
            <div class="clearfix"></div>

            <hr>

            {{-- limpio los floats --}}
            <div class="clearfix"></div>
            
            {{-- recibo entonces $images que contiene cada entrada de la tabla imagen en forma de objeto --}}
            @foreach($user->images as $image)
                @include('includes.image',['image' => $image])
            @endforeach


        </div>
    </div>
</div>
@endsection

