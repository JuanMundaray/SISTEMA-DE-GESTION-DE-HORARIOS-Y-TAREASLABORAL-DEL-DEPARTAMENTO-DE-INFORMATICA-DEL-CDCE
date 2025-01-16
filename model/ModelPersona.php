<?php

namespace App\Model;

class persona
{
	public $nombre_persona;
	public $apellido_persona;
	public $cedula;
    public $nro_telefono;

    //Funciones Set
	public function set_nombre_persona($nombre_persona)
	{
      $this->nombre_persona=trim($nombre_persona);
	}

	public function set_apellido_persona($apellido_persona)
	{
      $this->apellido_persona=trim($apellido_persona);
	}

	public function set_cedula($cedula)
	{
      $this->cedula=trim($cedula);
	}

	public function set_nro_telefono($nro_telefono)
	{
      $this->nro_telefono=trim($nro_telefono);
	}

    //Funciones Get
    public function get_nombre()
    {
        return $this->nombre_persona;
    }

    public function get_apellido()
    {
        return $this->apellido_persona;
    }

    public function get_cedula()
    {
        return $this->cedula;
    }

	public function get_nro_telefono()
	{
      return $this->nro_telefono;
	}
}
?>