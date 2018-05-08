<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 7/05/2018
 * Time: 2:10 PM
 */

namespace Controllers;

use Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController {

    public function get(Request $request, Response $response, $args) {
        /*esta función va con unos argumentos porque debo mandarle parámetros para buscar por cliente*/
        try{
            $id = $args['id']; //obtengo el parámetro cédula o id y lo almaceno en $id
            /*valido en el query que el id o cédula seal igual número enviado a buscar y obtengo lo primero que encuentre first()*/
            $user = User::where('id', $id)
                ->orWhere('cedula', $id)->first();

            return $response->withJson( $user, 200);

        }catch (\Exception $ex){
            return $response->withJson(['status' => $ex->getMessage()], 500);
        }

    }

    public function list(Request $request, Response $response) {

        return $response->withJson(User::all(), 200);
    }

    public function add(Request $request, Response $response) {
        try{
            //en la petición de post obtengo el array de parámetros con getParsedBody()
            $fields = $request->getParsedBody();
            $user = new User();
            //TODO add fields and validate
            $user->name   = array_get($fields, 'name', '');
            $user->cedula = array_get($fields, 'cedula', '');
            $user->id_profesion = array_get($fields, 'id_profesion', '');
            //ejecutamos save para guardar nuestros datos
            $user->save();

            return $response->withJson(['status' => 'created'], 201);

        }catch (\Exception $ex){
            return $response->withJson(['status' => $ex->getMessage()], 500);
        }
    }

    public function update(Request $request, Response $response, $args){
        /*esta función va con unos argumentos porque debo mandarle parámetros para actualizar por cliente*/

        try{
            $id = $args['id']; //obtengo el parámetro id para actualizar

            //en la petición de put obtengo el array de parámetros con getParsedBody()
            $fields = $request->getParsedBody();

            $user = new User();

            // Conseguimos el objeto
            $user = User::where('id', '=', $id) ->orWhere('cedula', $id)->first();

            // Si existe, seteamos las variables y guardamos
            if(!is_null($user)){
                // Seteamos
                $user->name   = array_get($fields, 'name', '');
                $user->cedula = array_get($fields, 'cedula', '');
                //ejecutamos save para guardar nuestros datos
                $user->save();
                return $response->withJson( "Usuario: ".$id." Actualizado", 200);
            }

        }catch (\Exception $ex){
            return $response->withJson('Error al actualizar el usuario: '.$id.'', 500);
        }
    }

    public function delete(Request $request, Response $response, $args) {
        /*esta función va con unos argumentos porque debo mandarle parámetros para eliminar por cliente*/
        try{
            $id = $args['id']; //obtengo el parámetro id y lo almaceno en $id
            /*valido en el query que el id o cédula seal igual número enviado a buscar y obtengo lo primero que encuentre first()*/
            if(User::where('id', $id)->delete()){

                return $response->withJson( "Usuario Eliminado con éxito:", 201);
            }
            return $response->withJson( "Inconveniente al eliminar usuario:".$id."", 500);

        }catch (\Exception $ex){
            return $response->withJson("Error al eliminar usuario: ".$id."", 500);
        }
    }
}