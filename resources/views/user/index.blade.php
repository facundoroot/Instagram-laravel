@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>People</h1>
            <hr>
            <form action="{{route('user.index')}}" method="GET" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control" placeholder="search user">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="search" class="btn btn-success">
                    </div>
                </div>
            </form>

            @foreach($users as $user)
                <div class="profile-user">

                    @if($user->image)
                            <div class="container-avatar"><img src="{{url('/user/avatar/'.$user->image)}}" class="avatar"></div>
                    @endif
    
                    <div class="user-info">
                        <h2>{{'@'.$user->nick}}</h2>
                        <h3>{{$user->name.' '.$user->surname}}</h3>
                        <a href="{{url('/user/profile/'.$user->id)}}" class="btn btn-success">See Profile</a>
                    </div>
                </div>
            @endforeach

        {{-- paginacion --}}
        {{-- uso clearfix para limpiar los floats --}}
        <div class="clearfix"></div>
        {{$users->links()}}


        </div>
    </div>
</div>
@endsection
