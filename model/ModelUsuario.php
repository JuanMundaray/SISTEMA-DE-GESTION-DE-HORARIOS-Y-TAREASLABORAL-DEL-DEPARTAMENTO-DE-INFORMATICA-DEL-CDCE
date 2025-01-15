<?php 
require_once('ModelPersona.php');
require_once('ORM');

class usuario extends persona
{
	private $id_usuario;
	private $nombre_usuario;
	private $contrasena;
	private $rol_usuario;
	private $departamento_usuario;
    private $fecha_creacion;
    private $activo;
    private $orm=new ORM("usuarios");

    public function __construct()
    {
        $this->activo=true;
    }

	public function insertar_usuario()
    {
        $this->orm->insert([
            'nombre_persona'=>'juan'
            'apellido _persona'=>'juan'
            'nombre_usuario'=>'juan'
            'nombre_persona'=>'juan'
            'nombre_persona'=>'juan'
        ]);
    }

    public function actualizar_usuario()
    {
        $resultado = false;
        try{
            $contrasena = $this->contrasena;
            $rol_usuario = $this->rol_usuario;
            $nombre_persona = $this->nombre_persona;
            $apellido_persona=$this->apellido_persona;
            $cedula = $this->cedula;
            $departamento_usuario = $this->departamento_usuario;
            $id_usuario=$this->id_usuario;
            $activo=$this->activo;
            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.usuario
            SET 
            rol_usuario=:rol_usuario,
            nombre_persona=:nombre_persona,
            apellido_persona=:apellido_persona,
            cedula=:cedula,
            departamento_usuario=:departamento_usuario,
            activo=:activo
          	WHERE id_usuario='$id_usuario'";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ":rol_usuario"=>$rol_usuario,
            ":nombre_persona"=>$nombre_persona,
            ":apellido_persona"=>$apellido_persona,
            ":cedula"=>$cedula,
            ":departamento_usuario"=>$departamento_usuario,
            "activo"=>$activo));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();                   
        } 
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function eliminar_usuario()
    {
    }

    function obtener() {
    }
    

    public function obtener_usuario($tabla, $columnas = '*', $condiciones = [], $orden = '', $limite = '')
    {
    }

    //FUNCION PARA QUE EL USUARIO HAGA LOGIN

    public function login($nombre_usuario,$contrasena)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();  
            
            //COMPROBAR SI EL USUARIO EXISTE

            $consulta = "SELECT * FROM 
            actividades.usuario
            WHERE nombre_usuario = :nombre_usuario AND activo=true";

            $resultadoPDO = $db->prepare($consulta);

            $resultadoPDO->execute(array(
            ":nombre_usuario"=>$nombre_usuario));

            $coincidencia=$resultadoPDO->rowCount();
            $usuario_coincidencia=$resultadoPDO->fetchAll();
            
            //SI EL USUARIO EXISTE REALIZAR ESTO

            if ($coincidencia==1) {
                //COMPROBAR SI LA CONTRASEÑA COINCIDE
                if((password_verify($contrasena,$usuario_coincidencia[0]['contrasena'])||($contrasena==$usuario_coincidencia[0]['contrasena']))){
                    $consulta="SELECT * FROM 
                    actividades.usuario
                    LEFT JOIN actividades.departamentos
                    ON usuario.departamento_usuario=departamentos.id_departamento
                    WHERE nombre_usuario = :nombre_usuario";
                    $resultadoPDO = $db->prepare($consulta);
                    $resultadoPDO->execute(array(
                    ":nombre_usuario"=>$nombre_usuario));
                    $resultado=$resultadoPDO->fetchAll();
                    $resultadoPDO->closeCursor();

                    session_start();
                    $_SESSION["rol_usuario"]=$resultado[0]["rol_usuario"];
                    $_SESSION["id_usuario"]=$resultado[0]["id_usuario"];
                    $_SESSION["nombre_departamento"]=$resultado[0]["nombre_departamento"];
                    $_SESSION["departamento_usuario"]=$resultado[0]["departamento_usuario"];
                    $_SESSION["nombre_usuario"]=$nombre_usuario;
                    header('location:../View/Dashboard.php');
                    exit();
                }
                //ESTO SUCEDE SI LA CONTRASEÑA NO COINCIDE
                else{
                    echo $usuario_coincidencia[0]['contrasena'];
                    header('location:../View/login.php?ERR_PASSWORD');
                    exit();
                }
            }   

            elseif(empty($resultado)){
                header('location:../View/login.php?ERR_INEXISTENCIA');
                exit();
            }
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }


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

    //funciones set
    
	public function set_id_usuario($id_usuario)
	{
      $this->id_usuario=trim($id_usuario);
	}

	public function set_nombre_usuario($nombre_usuario)
	{
      $this->nombre_usuario=trim($nombre_usuario);
	}

	public function set_contrasena($contrasena)
	{
      $this->contrasena=trim($contrasena);
	}

	public function set_tipoUsuario($rol_usuario)
	{
      $this->rol_usuario=trim($rol_usuario);
	}

	public function set_departamento_usuario($departamento_usuario)
	{
      $this->departamento_usuario=trim($departamento_usuario);
	}

    public function set_fecha_creacion($fecha_creacion)
	{
      $this->fecha_creacion=trim($fecha_creacion);
	}

    public function set_activo($activo)
	{
      $this->activo=trim($activo);
	}

    //funciones get

	public function get_id()
	{
      return $this->id_usuario;
	}

	public function get_nombre_usu()
	{
      return $this->nombre_usuario;
	}

	public function get_contrasena()
	{
      return $this->contrasena;
	}

	public function get_tipo()
	{
      return $this->rol_usuario;
	}

	public function get_departamento_usuario()
	{
      return $this->departamento_usuario;
	}
}

