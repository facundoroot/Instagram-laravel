<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // le indico con que tabla va a estar interactuando
    // uso la propiedad protected $table
    protected $table = 'images';

    // ahora hago una relacion One to Many o sea de uno a muchos, una imagen puede tener muchos comentarios
    public function comments()
    {
        // va a servir para sacar todos los comentarios que tenga asignado a una imagen
        // voy a usar esta funcion que automaticamente hace la magia con el modelo comments y me va a traer todos los comentarios
        // va a ver que tiene en la tabla comentarios  un image_id que sirve para hacer la relacion entre la imagen y los comentarios arraigados al id de esa imagen y me va a sacar un objeto con todos los comentarios
        return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
    }

    // hago un One to Many con los likes
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    // ahora saco la inversa, muchas imagenes pueden crearla un unico usuario, una relacion de muchos a uno
    public function user()
    {
        // en este caso miro en la tabla de Image y en la columna de user_id me la va a relacionar con el modelo user
        // de esta manera me saca de usuarios los objetos que pertenezcan a la id de user_id de esta entidad
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
