<?php

    abstract class Producto {
        // usamos el trait sin necesidad de inyectar el fichero FormateaPrecio.php porque lo detecta automáticamente
        use FormateaPrecio;


        // creamos los atributos protegidos y su constructor
        protected $codigo;
        protected $nombre;
        protected $precioBase;

        public function __construct($codigo, $nombre, $precioBase) {
            $this->codigo = $codigo;    
            $this->nombre = $nombre;
            $this->precioBase = $precioBase;
        }


        // métodos abstractos
        abstract public function getTipo(): string;
        abstract protected function getIva(): float;


        // métodos concretos
        public function getCodigo(): string {
            return $this->codigo;
        }
        public function getNombre(): string {
            return $this->nombre;
        }
        public function getPrecioBase(): float {
            return $this->precioBase;
        }
        public function getDescuento(): float {
            return 0.0;
        }
        public function getPrecioFinal():float {
            // en el fichero nos pide que hagamos la operación de "precioFinal" con variables que no hemos creado anteriormente, es por ello que creamos esas variables y le damos los valores de las variables que están fuera de la función para así al final usarlo en el código

            $descuento = $this->getDescuento();
            $iva = $this->getIva();

            $precioFinal = $this->precioBase * ( 1 - $descuento / 100) * (1 + $iva / 100);

            // también nos pide que redondeemos el precioFinal obtenido a 2 decimales
            return round($precioFinal, 2);
        }
        // es String porque en el fichero FormateaPrecio.php tenemos puesto que la función tendrá como salida un String

        // Luego le decimos que queremos que devuelva la función (esta función llamada formatearPrecio) de la función creada anteriormente para que calcule el precioFinal ($this->getPrecioFinal())
        public function getPrecioFinalFormateado(): string {
            return $this->formatearPrecio($this->getPrecioFinal());
        }
    }