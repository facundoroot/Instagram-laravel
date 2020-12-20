                <div class="card pub_image">
                    <div class="card-header">
                        {{-- recordar que user gracias a los modelos nos conecta con la tabla de usuarios y dentro de user miro la columna imagen --}}
                        @if($image->user->image)
                        <div class="container-avatar"><img src="{{url('/user/avatar/'.$image->user->image)}}" class="avatar"></div>
                        @endif

                        <div class="data-user">
                            <a href="{{url('/user/profile/'.$image->user->id)}}">
                            {{ $image->user->name.' '.$image->user->surname}}
                            <span class="nickname">
                              {{' | @'.$image->user->nick}}
                            </span>

                            </a>
                        </div>

                        <div class="card-body">
                            <div class="image-container">
                                {{-- ver que image_path es una de las columnas del objeto imagen --}}
                            <img src="{{url('/image/file/'.$image->image_path)}}">
                            </div>

                            <div class="description">
                                <span class="nickname"> {{'@'.$image->user->nick}} </span>
                                <span class="nickname date">{{' | '.$image->created_at}}</span>
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

                            <div class="comments">
                            <a href="{{url('/image/detail/'.$image->id)}}" class="btn btn-sm btn-warning">Comments ({{count($image->comments)}})</a>
                            </div>

                        </div>
                    </div>
                </div>