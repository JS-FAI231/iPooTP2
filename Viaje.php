<?php
/**
 * Clase Viaje.php
 * JORGE SEGURA
 * FAI 231
 * Introduction a la Programacion Orientada a Ojetos
 */

    include 'Pasajero.php';
    include 'ResponsableV.php';

    class Viaje{
        
        private $codigo;
        private $destino;
        private $cantMaxPasajeros;
        private $colPasajeros;   //delegacion clase Pasajero
        private $responsable;     //delegacion clase ResponsableV

        public function __construct($unCodigo,$unDestino,$unaCant){
            $this->codigo=$unCodigo;
            $this->destino=$unDestino;
            $this->cantMaxPasajeros=$unaCant;
            $this->colPasajeros=[];  /*Array multidimensional que contendra los arrays asociativos de cada pasajero*/
            $this->responsable=new ResponsableV("","","","");
        }

        /* Metodos de acceso a las variables de instancia Setters */
        /**
         * @param string $auxCodigo
         */
        public function setCodigo($auxCodigo){
            $this->codigo=$auxCodigo;            
        }
        /**
         * @param string $auxDestino
         */
        public function setDestino($auxDestino){
            $this->destino=$auxDestino;
        }
        /**
         * @param int $auxCant
         */
        public function setCantMaxPasajeros($auxCant){
            $this->cantMaxPasajeros=$auxCant;
        }
        /**
         * @param array $auxColPas
         */
        public function setColPasajeros($auxColPas){
            $this->colPasajeros=$auxColPas;
        }
        /**
         * @param object $auxResponsabale
         */
        public function setResponsable($auxResponsabale){
            $this->responsable=$auxResponsabale;
        }

        /* Metodos de acceso a las variables de instancia Getters) */
        /**
         * @return string
         */
        public function getCodigo(){
            return ($this->codigo);
        }   
        /**
         * @return string
         */    
        public function getDestino(){
            return ($this->destino);
        }
        /**
         * @return int
         */
        public function getCantMaxPasajeros(){
            return($this->cantMaxPasajeros);
        }
        /**
         * @return array
         */
        public function getColPasajeros(){
            return ($this->colPasajeros);
        }
        /**
         * @return object
         */
        public function getResponsable(){
            return $this->responsable;
        }


        /**
         * @return string
         */
        public function __toString(){
            $objResp=$this->getResponsable();
            $datosResp=$objResp->__toString();
            return ("Codigo: ".$this->getCodigo()."  Destino: ".$this->getDestino()." CantMaxPasajeros: ".$this->getCantMaxPasajeros()."\n"
                    ."Pasajeros: \n".$this->mostrarPasajeros()."\n"
                    ."Responsable: ".$datosResp."\n");
        }


        
        /**
         * @return string
         */
        public function mostrarPasajeros(){
            $auxCol=$this->getColPasajeros();
            $pasajeros="";

            for ($i=0;$i<count($auxCol);$i++){
                $objPersona=$auxCol[$i];
                $pasajeros=$pasajeros.$objPersona->__toString()."\n";
            }
            return $pasajeros;
        }

        /**
         * @return int
         */
        public function disponibilidad(){
            return ($this->getCantMaxPasajeros() - count($this->getColPasajeros()));
        }

        /**
         * @param string $auxCodigo
         * @return boolean
         */
        public function existeViaje($auxCodigo){
            return ($this->getCodigo()==$auxCodigo);
        }
        /**
         * @return boolean
         */
        public function existeLugar(){
            return ($this->getCantMaxPasajeros()>count($this->getColPasajeros()));
        }
        /**
         * @param string $unDni
         * @return boolean
         */
        public function existeDni ($unDni){
            $existe=false;
            $auxCol=$this->getColPasajeros();
            $i=0;

            while($i<count($auxCol) && !$existe){
                $objPasajero=$auxCol[$i];
                if ($objPasajero->getDni()==$unDni){
                    $existe=true;
                }
                $i++;
            }

            return $existe;
        }

        /**
         * Metodo interno devuelve la posicion de un pasajero en el array colPasajeros
         * coincidente con el dni
         * @param string $unDni
         * @return int
         */
        private function indexDni($unDni){
            $auxIndice = -1;
            foreach ($this->getColPasajeros() as $indice=>$elemento){
                if ($elemento->getDni()==$unDni){
                    $auxIndice=$indice;
                }
            }
            return $auxIndice;
        }
        /**
         * Metodo que elimina un pasajero por dni, asumiendo que el dni existe.
         * @param string $unDni
         */
        public function eliminarPasajero($unDni){
            //indice del elemento a eliminar coincidente con el dni, si no lo encuenta obtiene -1
            $indiceElim=$this->indexDni($unDni);  

            if ($indiceElim > -1){
                $arrPasajeros=$this->getColPasajeros();
                array_splice($arrPasajeros,$indiceElim,1);
                $this->setColPasajeros($arrPasajeros);
            }
        }
        /**
         * Metodo que modificar los datos de un pasajero por dni, asumiendo que el dni existe.
         * @param string $unNombre
         * @param string $unApellido
         * @param string $unDni
         */
        public function modificarPasajero($unDni,$nuevoNombre,$nuevoApellido,$nuevoDni,$nuevoTelef){
            $indiceMod=$this->indexDni($unDni);
            if ($indiceMod > -1){
                $arrPasajeros=$this->getColPasajeros();
                $objPasajero=$arrPasajeros[$indiceMod];
                $objPasajero->setNombre($nuevoNombre);
                $objPasajero->setApellido($nuevoApellido);
                $objPasajero->setDni($nuevoDni);
                $objPasajero->setTelfono($nuevoTelef);
                
                $this->setColPasajeros($arrPasajeros);
            }
        }


        /**
         * Metodo que agrega a un nuevo pasajero, asumiendo que no existe.
         *     Recupero el la coleccion de pasajeros,
         *     creo un array asoc. para el nuevo parajero
         *     incremento el contador del array de los pasajeros
         *     agrego el nuevo array asoc. al la coleccion.
         *     asigno el array actualizado.
         * @param string $auxNombre,$auxApellido,$auxDni
         */
        public function agregarPasajero($auxNombre,$auxApellido,$auxDni,$unTelefono){

            $auxColPasajeros=$this->getColPasajeros();
            //$nuevoPasajero=["nombre"=>$auxNombre,"apellido"=>$auxApellido,"dni"=>$auxDni];
            $nuevoPasajero=new Pasajero($auxNombre,$auxApellido,$auxDni,$unTelefono);
            $nuevaPos=count($auxColPasajeros);

            $auxColPasajeros[$nuevaPos]=$nuevoPasajero;
            $this->setColPasajeros($auxColPasajeros);
        }

       
    }
?>