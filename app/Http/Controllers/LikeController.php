<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    // le aplico el middleware para que solo puedan entrar los identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = \Auth::user();

        $likes = Like::where('user_id', $user->id)->orderBy('id','desc')->paginate(5);

        return view('like.index',[
            'likes' => $likes
        ]);
    }

    public function like($image_id){
        // recoger datos del usuario y la imagen
        $user = \Auth::user();

        // condicion para ver si ya existe el like y no duplicarlo
        // con el where miro si son iguales
        $isset_like = Like::where('user_id',$user->id)
                            ->where('image_id',$image_id)
                            ->count();
        

        if($isset_like == 0){
        $like = new Like();
        $like->user_id = $user->id;
        // convierto en entero
        $like->image_id = (int)$image_id;

        // guardo en la base de datos
        $like->save();

        return response()->json([
            'like' => $like
        ]);
        }else{
            return response()->json([
            'message' => 'like already exist'
            ]);
        }
    }

    public function dislike($image_id){
        // recoger datos del usuario y la imagen
        $user = \Auth::user();

        // condicion para ver si ya existe el like y no duplicarlo
        // con el where miro si son iguales
        $like = Like::where('user_id',$user->id)
                            ->where('image_id',$image_id)
                            ->first();
        

        if($like){

        // elimino like
        $like->delete();

        return response()->json([
            'like' => $like,
            'message' => 'disliked'
        ]);
        }else{
            return response()->json([
            'message' => 'like doesent exist'
            ]);
        }
    }


}
