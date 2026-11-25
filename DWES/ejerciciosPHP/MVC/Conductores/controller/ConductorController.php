<?php
require_once("./model/Conductor.php");

class ConductorController
{
    // ---- INDEX PRINCIPAL ----
    public function index()
    {
        $rowset = Conductor::getAll();
        require("view/index.php");
    }

    // ---- VER CONDUCTOR POR ID ----
    public function ver(int $id)
    {
        $row = Conductor::getConductor($id);
        if ($row !== null) {
            $rowset = [$row];
            require("view/ver.php");
        } else {
            $this->index();
        }
    }

    // ---- BORRAR UN CONDUCTOR POR SU ID ----
    public function borrar(int $id)
    {
        if (Conductor::getConductor($id) === null) {
            echo "No existe ese conductor";
            return;
        }
        Conductor::borrarConductor($id);
        $this->redirigir();
    }

    // ---- MOSTRAR FORMULARIO DE ALTA ----
    public function formularioAlta(?string $mensaje = null)
    {
        require("view/formularioAlta.php");
    }

    // ---- PROCESAR ALTA ----
    public function guardar(array $data)
    {
        $nombre = trim($data['nombre'] ?? '');
        $puntos = trim($data['puntos'] ?? '');
        $ciudad = trim($data['ciudad'] ?? '');
        $multas = trim($data['multas'] ?? '');
        $estado = trim($data['estado'] ?? '');
        $creado = $this->normalizarFecha($data['creado'] ?? '');

        if ($error = $this->validar($nombre, $puntos, $ciudad, $multas, $estado)) {
            $this->formularioAlta($error);
            return;
        }

        // id = 0 porque lo asignará la base de datos (AUTO_INCREMENT)
        $conductor = new Conductor(0, $nombre, (int)$puntos, $ciudad, (int)$multas, $estado, $creado, '');

        if ($conductor->insertarConductor()) {
            $this->redirigir();
        } else {
            $this->formularioAlta("No se pudo crear el conductor");
        }
    }

    // ---- MOSTRAR FORMULARIO DE ACTUALIZACIÓN (con datos precargados) ----
    public function formularioActualizacion(int $id, ?string $mensaje = null)
    {
        $conductor = Conductor::getConductor($id);
        if ($conductor === null) {
            $this->index();
            return;
        }
        require("view/formularioActualizacion.php");
    }

    // ---- PROCESAR ACTUALIZACIÓN ----
    public function actualizar(int $id, array $data)
    {
        $existente = Conductor::getConductor($id);
        if ($existente === null) {
            echo "No existe ese conductor";
            return;
        }

        $nombre = trim($data['nombre'] ?? '');
        $puntos = trim($data['puntos'] ?? '');
        $ciudad = trim($data['ciudad'] ?? '');
        $multas = trim($data['multas'] ?? '');
        $estado = trim($data['estado'] ?? '');

        if ($error = $this->validar($nombre, $puntos, $ciudad, $multas, $estado)) {
            $this->formularioActualizacion($id, $error);
            return;
        }

        // Conservamos creado/modificado originales: el SQL ya pone modificado = NOW()
        $conductor = new Conductor(
            $id,
            $nombre,
            (int)$puntos,
            $ciudad,
            (int)$multas,
            $estado,
            $existente->creado,
            $existente->modificado
        );

        if ($conductor->actualizarConductor($id)) {
            $this->redirigir();
        } else {
            // rowCount() = 0 también ocurre si no cambió ningún dato
            $this->formularioActualizacion($id, "No se pudo actualizar (o no había cambios)");
        }
    }

    // ---- AUXILIARES ----

    // Devuelve un mensaje de error o null si todo es válido
    private function validar(string $nombre, string $puntos, string $ciudad, string $multas, string $estado): ?string
    {
        if ($nombre === '' || $ciudad === '' || $estado === '') {
            return "Es obligatorio rellenar todos los campos";
        }
        if (!ctype_digit($puntos)) {
            return "Los puntos han de ser un número entero no negativo";
        }
        if (!ctype_digit($multas)) {
            return "Las multas han de ser un número entero no negativo";
        }
        return null;
    }

    // "2026-10-23T14:30" -> "2026-10-23 14:30:00"
    private function normalizarFecha(string $fecha): string
    {
        $fecha = trim($fecha);
        if ($fecha === '') {
            return date('Y-m-d H:i:s');
        }
        $fecha = str_replace('T', ' ', $fecha);
        return strlen($fecha) === 16 ? $fecha . ':00' : $fecha;
    }

    // Post/Redirect/Get: evita reenviar el formulario al recargar
    private function redirigir(string $url = 'index.php')
    {
        header("Location: $url");
        exit;
    }
}