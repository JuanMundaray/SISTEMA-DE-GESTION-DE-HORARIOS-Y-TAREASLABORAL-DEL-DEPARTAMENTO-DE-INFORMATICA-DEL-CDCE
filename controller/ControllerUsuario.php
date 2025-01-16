<?php
namespace App\Controller;

require_once("../model/ModelUsuario.php");
use App\Model\usuario;

$usuario = new usuario();
// $option=$_REQUEST['option'];
switch(2){
    case 1 :
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

    case 2 :
        $resultado = $usuario->actualizar_usuario(7,"id_usuario");

        echo $resultado;
    break;
}