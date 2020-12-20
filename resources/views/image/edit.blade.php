@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Edit Image</div>
            
                <div class="card-body">
                    <form action="{{route('image.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="image_id" value="{{$image->id}}">

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="image_path">Image</label>
                            <div class="col-md-6">

                                @if($image->user->image)
                                     <div class="image-container"><img src="{{url('/image/file/'.$image->image_path)}}"></div>
                                @endif

                                <input type="file" id="image_path" name="image_path" class="form-control" >
                                @if($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('image_path')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="description">Description</label>
                            <div class="col-md-6">
                                <textarea  id="description" name="description" class="form-control" >{{$image->description}}</textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value="Update Image">

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection