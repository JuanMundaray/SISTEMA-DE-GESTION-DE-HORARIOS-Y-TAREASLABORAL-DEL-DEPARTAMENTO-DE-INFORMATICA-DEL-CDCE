<?php
namespace App\Controller;

require_once("../model/ModelUsuario.php");
use App\Model\usuario;
use PDO;

$usuario = new usuario();
$option=$_REQUEST['option'];

switch($option){
    case "insertar_usuario" :
        $resultado = $usuario->insertar_usuario([
            'nombre'=>'juan',
            'apellido'=>'mundaray',
            'cedula'=>'31157430',
            'nombre_usuario'=>'demo',
            'contrasena'=>'1234',
            'email'=>'juanfmundaray2804@gmail.com',
            'telefono'=>'04121878875',
            'fecha_creacion'=>'28-12-24',
            'id_departamento'=>1,
            'id_rol_usuario'=>1
            
        ]);

        echo $resultado;
    break;

    case "eliminar_usuario" :
        $resultado = $usuario->eliminar_usuario(
            ["id_usuario"=>7]
        );

        echo $resultado;
    break;

    case "login" :
        // Obtener los valores enviados desde el formulario
        $cedula = $_POST['cedula'];
        $password = $_POST['password'];
        
        $response = $usuario -> login($cedula,$password);

        echo json_encode($response);

    break;
}