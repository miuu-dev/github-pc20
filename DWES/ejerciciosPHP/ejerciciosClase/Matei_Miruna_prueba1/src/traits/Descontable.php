<?php 

    trait Descontable {
        private float $descuento = 0.0;
        public function aplicarDescuento(float $porcentaje): void {
            if ($porcentaje < 0 || $porcentaje > 50) {
                throw new InvalidArgumentException("El descuento debe estar entre 0 y 50.");
            }
            $this->descuento = $porcentaje;
        }

        public function getDescuento(): float {
            return $this->descuento;
        }
    }

?>