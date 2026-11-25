<?php

    abstract class Producto {
        // le indicamos que queremos usar el trait FormataPrecio para, conforme hagamos los cálculos, podamos hacerlo de forma limpia y ordenada 
        use FormateaPrecio;

        // creamos atributos protegidos para solo usarlo en esta clase
        public function __construct(
                                    protected string $codigo, 
                                    protected string $nombre, 
                                    protected float $precioBase
                                ) {
            // No se require ninguna asignación interna porque ya lo hace autmomáticamente
        }

        // métodos set aplicados con Fluent Interface
        public function setCodigo(string $codigo) {
            $this->codigo = $codigo;
            return $this;
        }

        public function setNombre(string $nombre) {
            $this->nombre = $nombre;
            return $this;
        }

        public function setPrecioBase(float $precioBase) {
            $this->precioBase = $precioBase;
            return $this;
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
?>