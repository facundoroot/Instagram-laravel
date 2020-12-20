<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;


class ImageController extends Controller
{
    // le aplico el middleware para que solo puedan entrar los identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        // validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required||mimes:jpg,png,jpeg,gif,svg',
        ]);

        // recoger los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');



        // asigno valores al objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        if($image_path){

            // le doy el nombre que tiene el tiempo que se subio la imagen concatenado con el nombre original de la imagen(con la action interna de laravel Get Client Original Name),
            //  ya que el image_path me trae un monton de cosas mas
            $image_path_name= time().$image_path->getClientOriginalName();
            // entro al sorage imagen, uso put para guardar la imagen en la carpeta images, le paso el nombre y le uso file get para pasarle el archivo
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            // le doy el nuevo valor del nombre
            $image->image_path = $image_path_name;
        }
            // ahora la guardo en la db
            $image->save();


            return redirect()->route('home')->with([
                'message' => 'Image Uploaded'
            ]);
    }

	public function getImage($filename){
		$file = Storage::disk('images')->get($filename);
		return new Response($file, 200);
    }
    
    public function detail($id){
        // al metodo find si le paso un id me devuelve ese objeto
        $image=Image::find($id);

        return view('image.detail',[
            'image' => $image
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id) ->get();
        $likes = Like::where('image_id',$id)->get();

        if($user && $image && $image->user->id == $user->id){
            // eliminar comentarios
            if($comments && count($comments) >= 1){
                foreach($comments as $comment){
                    $comment->delete();
                }

            }
            // eliminar likes
            if($likes && count($likes) >= 1){
                foreach($likes as $like){
                    $like->delete();
                }

            }
            // eliminar ficheros de imagen
            Storage::disk('images')->delete($image->image_path);

            // eliminar registro de la imagen
            $image->delete();

            $message = array('message' => 'Image Delete');
        }else{
            $message = array('message' => 'Image Delete Failed');
        }

        return redirect()->route('home')->with('message');
    }

    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){

            return view('image.edit',[
                'image' => $image
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        // validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required||mimes:jpg,png,jpeg,gif,svg',
        ]);


        // recojo datos
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');


        // consigo el objeto image de la base de datos
        $image = Image::find($image_id);
        $image->description = $description;


        if($image_path){

            // le doy el nombre que tiene el tiempo que se subio la imagen concatenado con el nombre original de la imagen(con la action interna de laravel Get Client Original Name),
            //  ya que el image_path me trae un monton de cosas mas
            $image_path_name= time().$image_path->getClientOriginalName();
            // entro al sorage imagen, uso put para guardar la imagen en la carpeta images, le paso el nombre y le uso file get para pasarle el archivo
            Storage::disk('images')->put($image_path_name,File::get($image_path));
            // le doy el nuevo valor del nombre
            $image->image_path = $image_path_name;
        }

        // Actualizar registro
        $image->update();

        return redirect()->route('image.detail',['id' =>$image_id])
        ->with(['message' => 'Image Updated']);

    }
}
