<?php 
namespace App\Model;

require_once("ModelPersona.php");
require_once("ORM.php");

use App\Model\persona;
use App\Model\ORM;
use Exception;

class usuario extends persona
{
      private $orm;

    public function __construct()
    {
        $this->orm = new ORM("usuario","gestion_trabajo");
    }

    //INSERTAR USUARIO
	public function insertar_usuario($data)
    {
        $resultado = $this->orm->insert($data);

        return $resultado;
    }
    
    //OBTENER USUARIO
    public function obtener_usuario(array $columns = [],array $joins = [],array $where = [], $limit = null)
    {
        try{
            $resultado = $this->orm->select(column:$columns, joins:$joins, where: $where, limit: $limit);
        }

        catch(Exception $e){
            $resultado = $e->getMessage();
        }

        return $resultado;

    }

    //ACTUALIZAR USUARIO 
    public function actualizar_usuario(array $data,array $column)
    {
    }

    //ELIMINACION CON SOFT DELETE
    public function eliminar_usuario(array $column)
    
    {
      $resultado = $this -> orm -> update(
            ["delete_at"=>  date('Y-m-d H:i:s')],
            $column
        );
      return $resultado;
    }

    //LOGIN DE USUARIO
    public function iniciar_sesion($cedula,$password){

        try{
            //COMPROBAR SI EXISTE EL USUARIO
            $resultado = $this->orm->select(where:["cedula" => $cedula]);

            // Leer el contenido del archivo y lo convierte en un array asociativo
            $app_responses = json_decode(file_get_contents('../config/app_responses.json'),true);
    
            //EL USUARIO SI EXISTE
            if(!empty($resultado)){
                //COMPROBAR SI LA CONTRASEÑA COINCIDE CON EL USUARIO
                $resultado = $this->orm->select(where:["cedula" => $cedula,"password" => $password]);//arreglar esto

        
                //SI LA CONTRASEÑA ES INCORRECTA DEVUELVE ESTO
                if(empty($resultado)){
                    $response = [
                        "success"=> $app_responses['PASSWORD_INCORRECTA']["success"],
                        "message" => $app_responses['PASSWORD_INCORRECTA']["message"],
                        "code" => $app_responses['PASSWORD_INCORRECTA']["code"]
                    ];
                }
                if(!empty($resultado)){
                    $response = [
                        "success"=> $app_responses['RESPUESTA_EXITOSA']["success"],
                        "code" => $app_responses['RESPUESTA_EXITOSA']["code"],
                        "message" => $app_responses['RESPUESTA_EXITOSA']["message"],
                        "data" => $resultado
                    ];

                    session_start();
                    //GUARDAR TODOS LOS DATOS DEL USUARIO EN LA SESION
                    foreach ($resultado as $row) {
                        foreach ($row as $columnName => $value) {
                            // Usar el nombre de la columna como el nombre de la variable de sesión
                            $_SESSION[$columnName]= $value;
                        }
                    }
                }
            }
            
            //EL USUARIO NO EXISTE
            else{
                $response = [
                    "success"=> $app_responses['USUARIO_INEXISTENTE']["success"],
                    "message" => $app_responses['USUARIO_INEXISTENTE']["message"],
                    "code" => $app_responses['USUARIO_INEXISTENTE']["code"]
                ];
            }
        }

        catch(Exception $e){
            $response = [
                "success"=> false,
                "error" => $e -> getMessage(),
                "message" => "ERROR SQL",
                "data" => null
            ];
        }

        return $response;

    }

    public function cerrar_sesion()
    {
        try{
            session_start();
            session_destroy();
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
        }
    }
}

