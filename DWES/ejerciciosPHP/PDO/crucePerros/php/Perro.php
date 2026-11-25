<?php

    class Perro {

        // constructor con los atributos por la versión de PHP 8.0
        public function __construct(
                public string $raza,
                public string $color,
                public float $peso,
                public int $edad,
                public string $sexo,
            ) {
                $this->sexo = strtolower(trim($sexo)); // esto sirve para obligar que el sexo sea en minúsculas y sin espacios
            }
        

        // getters
        public function getRaza(): string {
            return $this->raza;
        }

        public function getColor(): string {
            return $this->color;
        }

        public function getPeso(): float {
            return $this->peso;
        }

        public function getEdad(): int {
            return $this->edad;
        }

        public function getSexo(): string {
            return $this->sexo;
        }


        // setters con Fluent Interface
        public function setRaza(string $raza) {
            $this->raza = $raza;
            return $this;
        }

        public function setColor(string $color) {
            $this->color = $color;
            return $this;
        }

        public function setPeso(float $peso) {
            $this->peso = $peso;
            return $this;
        }

        public function setEdad(int $edad) {
            $this->edad = $edad;
            return $this;
        }

        public function setSexo(string $sexo) {
            $this->sexo = $sexo;
            return $this;
        }

        
        // método cruzar 
        public function cruzar(Perro $otroPerro): ?Perro {
            // primero comprobamos que no son del mismo sexo
            if($this->sexo === $otroPerro->getSexo()) {
                return null;
            }

            // en caso de que no es el mismo, le indicamos que tome el sexo de la madre
            if ($this->sexo === 'hembra') {
                $madre = $this;
            } else {
                $madre = $otroPerro;
            }

            // una vez listo, crearemos un nuevo perro con los atributos de la madre en raza y color, el sexo será hembra por defecto, el peso será 1.0 y la edad 0
            return new Perro(
                raza: $madre->getRaza(),
                color: $madre->getColor(),
                peso: 1.0,
                edad: 0,
                sexo: 'hembra' // por defecto, el cachorro será hembra
            );
        }
    }

?>