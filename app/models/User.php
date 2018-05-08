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
 * @property int $id
 * @property string $name
 * @property int $cedula
 * @property int $id_profesion
 */
class User extends Model{

    protected $table = 'clientes';
    public $timestamps = false;

    /**
     * relaciono tabla de usuario con profesion
     * el método va en singular  porque un usuario tiene una profesion
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pofesion(){
            //esto indica que un usuario pertenece a una profesion
            return $this->belongsTo(Profesion::class);
    }

}