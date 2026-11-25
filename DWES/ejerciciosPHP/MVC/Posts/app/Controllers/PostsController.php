<?php
require 'app/Models/Post.php';

class PostsController
{
    /**
     * Función que envía todos los Post a la vista Home
     */
    public function index()
    {
        $posts = Post::getAll();
        require VIEWS_PATH . '/home.php';
    }

    /**
     * Función que envía el post seleccionado a la vista Show
     */
    public function show(int $id)
    {
        $post = Post::getById($id);
        require VIEWS_PATH . '/show.php';
    }

    public function formularioActualizacion(int $id, ?string $mensaje = null)
    {
        $post = Post::getById($id);
        if ($post === null) {
            $this->index();
            return;
        }
        require VIEWS_PATH . "/actualizarPost.php";
    }

    /**
     * con esta función podemos actualizar un post
     * @param int $id
     * @param array $data
     * @return void
     */
    public function actualizar(int $id, array $data)
    {
        $post = Post::getById($id);
        if ($post === null) {
            $this->index();
            return;
        }

        $titulo = trim($data['titulo'] ?? '');
        $cuerpo = trim($data['cuerpo'] ?? '');

        if ($titulo === '' || $cuerpo === '') {
            $this->formularioActualizacion($id, "El título y el cuerpo son obligatorios");
            return;
        }

        $post = new Post($id, $titulo, $cuerpo);

        if ($post->actualizarPost($id)) {
            $this->index();
        } else {
            $this->formularioActualizacion($id, "No se pudo actualizar (o no había cambios)");
        }
    }

    /**
     * mostrar formulario para crear un nuevo post
     * @param mixed $mensaje
     * @return void
     */
    public function formularioCrearPost(?string $mensaje = null) {
        require VIEWS_PATH . "/crearPost.php";
    }

    public function guardarPost(array $data) {
        $titulo = trim($data['titulo'] ?? '');
        $cuerpo = trim($data['cuerpo'] ?? '');

        if ($titulo === '' || $cuerpo === '') {
            $this->formularioCrearPost("El usuario y la contraseña son obligatorios.");
            return;
        }

        $post = new Post(0, $titulo, $cuerpo);

        if ($post->crearPost()) {
            $this->index();
        } else {
            $this->formularioCrearPost("No se pudo actualizar (o no había cambios)");
        }
    }
}
