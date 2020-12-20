<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        // primero que nada agarro las imagenes de mi base de datos
        // esto me trae cada imagen en forma de objeto
        // en vez de usar $images = Image::orderBy('id','desc')->get();
        // que me sirve para traer todas las imagenes
        // voy a usar paginate que tambien hace lo mismo pero me pagina la web tambien
        $images = Image::orderBy('id','desc')->paginate(5);


        return view('home',[
            'images' => $images
        ]);
    }
}
