<?php
require 'app/Models/Usuario.php';

class UsuarioController
{

    public function index()
    {
        require VIEWS_PATH . "/usuarioCreado.php";
    }

    /**
     * para dirigir a la página para iniciar sesión
     * @param mixed $mensaje
     * @return void
     */
    public function formularioLogin(?string $mensaje = null)
    {
        require VIEWS_PATH . "/loginUser.php";
    }

    /**
     * para dirigir a la página para crear un usuario
     * @param mixed $mensaje
     * @return void
     */
    public function register(?string $mensaje = null)
    {
        require VIEWS_PATH . "/registerUser.php";
    }

    /**
     * para guardar los datos del usuario a nuestra base de datos
     * @param array $data
     * @return void
     */
    public function crearUsuario(array $data)
    {
        $usuario = trim($data['usuario'] ?? '');
        $pwd = trim($data['pwd'] ?? '');

        if ($usuario === '' || $pwd === '') {
            $this->register("El usuario y la contraseña son obligatorios.");
            return;
        }

        $user = new Usuario(0, $usuario, $pwd);

        if ($user->registerUsuario()) {
            $this->index();
        } else {
            $this->register("No se pudo crear el usuario");
        }
    }

    public function login(?string $mensaje = null)
    {
        require VIEWS_PATH . "/loginUser.php";
    }

    public function iniciarSesion(array $data) {
        $usuario = trim($data['usuario'] ?? '');
        $pwd = trim($data['pwd'] ?? '');

        if ($usuario === '' || $pwd === '') {
            $this->login("El usuario y la contraseña son obligatorios.");
            return;
        }

        $user = new Usuario(0, $usuario, $pwd);

        if ($user->loginUsuario($usuario, $pwd)) {
            $this->index();
        } else {
            $this->login("No se pudo crear el usuario");
        }
    }
}
