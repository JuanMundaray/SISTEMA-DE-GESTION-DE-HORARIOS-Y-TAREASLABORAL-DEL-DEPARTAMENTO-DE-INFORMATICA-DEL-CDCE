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

	public function insertar_usuario($data)
    {
        $resultado = $this->orm->insert($data);

        return $resultado;
    }

    public function actualizar_usuario()
    {
    }

    public function eliminar_usuario($value,$column="id")
    {
      $resultado = $this -> orm -> delete($value,$column);
      return $resultado;
    }

    function obtener() {
    }
    

    public function obtener_usuario($tabla, $columnas = '*', $condiciones = [], $orden = '', $limite = '')
    {
    }

    //FUNCION PARA QUE EL USUARIO HAGA LOGIN

    // public function login($nombre_usuario,$contrasena)
    // {
    //     $resultado = false;
    //     try{

    //         //COMPROBAR SI EL USUARIO EXISTE

    //         $consulta = "SELECT * FROM 
    //         actividades.usuario
    //         WHERE nombre_usuario = :nombre_usuario AND activo=true";

    //         $resultadoPDO = $db->prepare($consulta);

    //         $resultadoPDO->execute(array(
    //         ":nombre_usuario"=>$nombre_usuario));

    //         $coincidencia=$resultadoPDO->rowCount();
    //         $usuario_coincidencia=$resultadoPDO->fetchAll();
            
    //         //SI EL USUARIO EXISTE REALIZAR ESTO

    //         if ($coincidencia==1) {
    //             //COMPROBAR SI LA CONTRASEÑA COINCIDE
    //             if((password_verify($contrasena,$usuario_coincidencia[0]['contrasena'])||($contrasena==$usuario_coincidencia[0]['contrasena']))){
    //                 $consulta="SELECT * FROM 
    //                 actividades.usuario
    //                 LEFT JOIN actividades.departamentos
    //                 ON usuario.departamento_usuario=departamentos.id_departamento
    //                 WHERE nombre_usuario = :nombre_usuario";
    //                 $resultadoPDO = $db->prepare($consulta);
    //                 $resultadoPDO->execute(array(
    //                 ":nombre_usuario"=>$nombre_usuario));
    //                 $resultado=$resultadoPDO->fetchAll();
    //                 $resultadoPDO->closeCursor();

    //                 session_start();
    //                 $_SESSION["rol_usuario"]=$resultado[0]["rol_usuario"];
    //                 $_SESSION["id_usuario"]=$resultado[0]["id_usuario"];
    //                 $_SESSION["nombre_departamento"]=$resultado[0]["nombre_departamento"];
    //                 $_SESSION["departamento_usuario"]=$resultado[0]["departamento_usuario"];
    //                 $_SESSION["nombre_usuario"]=$nombre_usuario;
    //                 header('location:../View/Dashboard.php');
    //                 exit();
    //             }
    //             //ESTO SUCEDE SI LA CONTRASEÑA NO COINCIDE
    //             else{
    //                 echo $usuario_coincidencia[0]['contrasena'];
    //                 header('location:../View/login.php?ERR_PASSWORD');
    //                 exit();
    //             }
    //         }   

    //         elseif(empty($resultado)){
    //             header('location:../View/login.php?ERR_INEXISTENCIA');
    //             exit();
    //         }
    //     }
    //     catch(Exception $objeto){
    //         echo $objeto->getMessage();
    //         $resultado = false;
    //     }
        
    //     return $resultado; 
    // }


    public function cerrarSesion()
    {
        $resultado = false;
        try{
            session_start();
            session_destroy();
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }
}

