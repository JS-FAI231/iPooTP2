<?php

class ResponsableV{
    private $nombre;
    private $apellido;
    private $numeroEmpleado;
    private $numeroLicencia;

    public function __construct($unNombre,$unApellido,$unNumEmp,$unNumLic){
        $this->nombre=$unNombre;
        $this->apellido=$unApellido;
        $this->numeroEmpleado=$unNumEmp;
        $this->numeroLicencia=$unNumLic;
    }

    public function setNombre($unNombre){
        $this->nombre=$unNombre;
    }
    public function setApellido($unApellido){
        $this->apellido=$unApellido;
    }
    public function setNumeroEmpleado($unNumEmp){
       $this->numeroEmpleado=$unNumEmp;
    }
    public function setNumeroLicencia($unNumLic){
        $this->numeroLicencia=$unNumLic;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getNumeroEmpleado(){
       return $this->numeroEmpleado;
    }
    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }

    public function __toString(){
        $a=$this->getNombre();
        $b=$this->getApellido();
        $c=$this->getNumeroEmpleado();
        $d=$this->getNumeroLicencia();
        return ("Responsable: ".$a." ".$b." NroEmpleado: ".$c." Licencia: ".$d."\n");
    }
    
}

?>