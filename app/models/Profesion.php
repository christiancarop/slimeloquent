<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 7/05/2018
 * Time: 11:24 AM
 */

namespace Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class User
 * @package Models
 * @property int $id_profesion
 * @property string $name
 */
class Profesion extends Model{

    protected $table = 'profesion';
    public $timestamps = false;

    //relaciono tabla de profesion con usuarios
    //el método va en plural  porque una profesión tiene muchos usuarios
    public function users(){
        //esto indica que a una profesion pertenecen varios usuarios
        //Una relación de este tipo me devuelve una colección de tipo eloquent
        return $this->hasMany(User::class);
    }

}