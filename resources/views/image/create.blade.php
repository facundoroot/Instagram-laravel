@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Upload new image</div>
            
                <div class="card-body">
                    <form action="{{ route('image.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="image_path">Image</label>
                            <div class="col-md-6">
                                <input type="file" id="image_path" name="image_path" class="form-control" required>
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
                                <textarea  id="description" name="description" class="form-control" required></textarea>
                                @if($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary" value="Upload Image">

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection