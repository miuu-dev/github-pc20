<?php
require_once("./model/Coche.php");
class CocheController
{
    public $coches;
    function __construct()
    {
        $this->coches = Coche::getAll();
    }

    public function index() {
        $rowset = $this->coches; // <-- Asegúrate de que esto esté presente
        require("view/index.php");
    }

    public function formularioAlta($mensaje = null)
    {
        require("view/formularioAlta.php");
    }

    public function formularioActualizacion(int $id)
    {
        // Buscamos el coche por ID para rellenar el formulario con sus datos actuales
        $row = Coche::getCoche($id); 
        if ($row != null) {
            require("view/formularioActualizacion.php");
        } else {
            echo "No existe el coche que deseas actualizar";
        }
    }


    public function ver(int $id)
    {
        $row = Coche::getCoche($id); 
        if ($row != null) {
            $rowset = [$row];
            require("view/ver.php"); // Corregido de ../view/ a view/
        } else {
            $this->index();
        }
    }

    public function verColor(string $color)
    {
        $rowset = [];
        $colorBusqueda = strtolower(trim($color));

        foreach ($this->coches as $coche) {
            $colorCoche = strtolower(trim($coche->color));
            if ($colorCoche == $colorBusqueda) {
                array_push($rowset, $coche);
            }
        }
        require("view/index.php"); // Corregido de ../view/ a view/
    }

    public function baja(int $id)
    {
        $victima = Coche::getCoche($id);
        if ($victima != null) {
            Coche::borrarCoche($id);
            $this->coches = Coche::getAll();
            $rowset = $this->coches;

            require("view/index.php"); // Corregido de ../view/ a view/
        } else {
            echo "No existe ese coche";
        }
    }

    public function alta(array $data)
    {
        $marca = trim($data["marca"] ?? '');
        $modelo = trim($data["modelo"] ?? '');
        $color = trim($data["color"] ?? '');
        $propietario = trim($data["propietario"] ?? '');
        $precio = $data["precio"] ?? '';

        // Validaciones...
        if ($marca == '' || $modelo == '' || $color == '' || $propietario == '') {
            $this->formularioAlta("Es obligatorio rellenar todos los campos");
            return;
        }

        if (!is_numeric($precio) || $precio <= 0) {
            $this->formularioAlta("El precio ha de ser mayor que 0");
            return;
        }

        $coche = new Coche($marca, $modelo, $color, $propietario, (float)$precio, null);

        if ($coche->insertarCoche()) {
            $this->coches = Coche::getAll();
            $rowset = $this->coches;

            require("view/index.php");
        } else {
            $this->formularioAlta("No se pudo dar de alta");
        }
    }

    public function actualizar(int $id, array $data)
    {
        // Variables de cada campo recogidas de $_POST
        $marca = trim($data["marca"] ?? '');
        $modelo = trim($data["modelo"] ?? '');
        $color = trim($data["color"] ?? '');
        $propietario = trim($data["propietario"] ?? '');
        $precio = $data["precio"] ?? '';

        // Validaciones básicas
        if ($marca == '' || $modelo == '' || $color == '' || $propietario == '') {
            echo "Es obligatorio rellenar todos los campos";
            return;
        }

        if (!is_numeric($precio) || $precio <= 0) {
            echo "El precio ha de ser mayor que 0";
            return;
        }

        // Creamos el objeto Coche pasándole los datos nuevos y el ID que estamos actualizando
        $coche = new Coche($marca, $modelo, $color, $propietario, (float)$precio, $id);

        // Llamamos al método actualizarCoche() que definimos en el modelo
        if ($coche->actualizarCoche()) {
            $this->coches = Coche::getAll();
            $rowset = $this->coches;

            require("view/index.php"); // Volvemos al listado mostrando el aviso verde
        } else {
            echo "No se pudo actualizar el coche";
        }
    }
}
