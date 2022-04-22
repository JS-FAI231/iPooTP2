<?php
class Pasajero
{
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    public function __construct($unNombre, $unApellido, $unDni, $unTelefono)
    {
        $this->nombre = $unNombre;
        $this->apellido = $unApellido;
        $this->dni = $unDni;
        $this->telefono = $unTelefono;
    }

    public function setNombre($unNombre)
    {
        $this->nombre = $unNombre;
    }
    public function setApellido($unApellido)
    {
        $this->apellido = $unApellido;
    }
    public function setDni($unDni)
    {
        $this->dni = $unDni;
    }
    public function setTelefono($unTelefono)
    {
        $this->telefono = $unTelefono;
    }


    public function getNombre()
    {
        return ($this->nombre);
    }
    public function getApellido()
    {
        return ($this->apellido);
    }
    public function getDni()
    {
        return ($this->dni);
    }
    public function getTelefono()
    {
        return ($this->telefono);
    }

    public function __toString()
    {
        $n = $this->getNombre();
        $a = $this->getApellido();
        $d = $this->getDni();
        $e = $this->getTelefono();
        return ($n . " " . $a . " " . $d . " ".$e."\n");
    }
}
