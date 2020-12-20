<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    // le aplico el middleware para que solo puedan entrar los identificados
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        // validacion
        $validate = $this->validate($request,[
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        
        // recojo datos
        $user = \Auth::user();
        $image_id=$request->input('image_id');
        $content = $request->input('content');

        // asigno los valores a mi objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content=$content;

        // guardo en la abse de datos
        $comment->save();

        return redirect()->route('image.detail',['id' => $image_id])
        ->with([
            'message' => 'comment uploaded'
        ]);


    }

    public function delete($id){
        // conseguir datos del usuario identificado
        $user = \Auth::user();

        // conseguir objeto del comentario
        $comment = Comment::find($id);

        // comprobar si soy el suenio del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            // borro y elimino de la base de datos con ORM
            $comment->delete();

                    return redirect()->route('image.detail',['id' => $comment ->image ->id])
                                     ->with([
                                        'message' => 'comment deleted'
                                            ]);


        }else{
                    return redirect()->route('image.detail',['id' => $comment ->image ->id])
                                                        ->with([
                                                            'message' => 'comment not deleted'
                                                                ]);
        }
    }
}
