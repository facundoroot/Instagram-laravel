@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.message')



                <div class="card pub_image">
                    <div class="card-header">
                        {{-- recordar que user gracias a los modelos nos conecta con la tabla de usuarios y dentro de user miro la columna imagen --}}
                        @if($image->user->image)
                        <div class="container-avatar"><img src="{{url('/user/avatar/'.$image->user->image)}}" class="avatar"></div>
                        @endif

                        <div class="data-user">
                            {{ $image->user->name.' '.$image->user->surname}}
                            <span class="nickname">
                              {{' | @'.$image->user->nick}}
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="details">
                                <div class="image-container">
                                    {{-- ver que image_path es una de las columnas del objeto imagen --}}
                                <img src="{{url('/image/file/'.$image->image_path)}}">
                                </div>
                            </div>
                            <div class="description">
                                <span class="nickname"> {{'@'.$image->user->nick}} </span>
                                <p>{{$image->description}}</p>
                            </div>

                            <div class="likes">
                                {{-- con asset me mete dentro de la carpeta public --}}
                               
                                {{-- comprobar si el usuario le dio like a la imagen --}}
                                <?php $user_like = false; ?>
                                @foreach ($image->likes as $like)
                                    @if($like->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                    @endif
                                @endforeach

                                @if($user_like)
                                    <img src="{{asset('img/red-heart.png')}}" data-id="{{$image->id}}" class="btn-dislike">
                                @else
                                    <img src="{{asset('img/black-heart.png')}}" data-id="{{$image->id}}" class="btn-like">
                                @endif
                                <span class="likes-count">{{count($image->likes)}}</span>
                            </div>


                            @if(Auth::user() && Auth::user()->id == $image->user->id)
                                <div class="actions">
                                    <a href="{{route('image.delete',['id' => $image->id])}}" class="btn btn-sm btn-danger">Delete</a>
                                    <a href="{{route('image.edit',['id' => $image->id])}}" class="btn btn-sm btn-primary">Update</a>
                                </div>
                            @endif

                            <div class="clearfix"></div>
                            <div class="comments">
                            <h2>Comments ({{count($image->comments)}})</h2>
                            <hr>

                            <form action="{{route('comment.save')}}" method="POST">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('description')}}</strong>
                                        </span>
                                    @endif
                                <p>
                                    <textarea name="content" class="form-control" required></textarea>
                                </p>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </form>


                            <hr>
                            @foreach($image->comments as $comment)
                              {{-- recordar que por los models al principio las conexiones que hicimos podemos encontrar facilmente conexiones entre las tablas para sacar los comentarios --}}
                                    <div class="description">
                                    <span class="nickname"> {{'@'.$comment->user->nick}} </span>
                                    <p>{{$comment->content}} <br>

                                    @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))  
                                        <a href="{{url('/comment/delete/'.$comment->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                    @endif
                                    </p>

                                </div>
                            @endforeach

                            </div>

                        </div>
                    </div>
                </div>


        </div>




    </div>
</div>
@endsection

