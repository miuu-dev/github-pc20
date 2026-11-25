<?php
define('VIEW_PATH', __DIR__ . '/app/Views');
require_once('app/Core/DB.php');
require_once('app/Controllers/PostsController.php');
require_once('app/Controllers/UsuarioController.php');

define('VIEWS_PATH', __DIR__ . '/app/Views');
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$home = "/www/MVCPosts";

$uri = str_replace($home, "", $uri_path);
define('BASE_URL', $home . '/index.php'); // para los enlaces de las vistas

$uri = str_replace($home, "", $uri_path);
$uri = preg_replace('#^/index\.php#', '', $uri);   // quita /index.php
$uri = rtrim($uri, '/') ?: '/';                    // "" o "/" => "/"

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$controller = new PostsController();
$controller2 = new UsuarioController();

switch ($uri) {
    case '/':
        $controller->index();
        break;

    case '/show':
        $controller->show($id ?: null);
        break;

    case '/editar':
        $controller->formularioActualizacion($id);
        break;

    case '/actualizar':
        $controller->actualizar($id, $_POST);
        break;

    case '/crear':
        $controller->formularioCrearPost();
        break;

    case '/registerUsuario':
        $controller2->crearUsuario($_POST);
        break;

    case '/loginUser':
        $controller2->iniciarSesion($_POST);
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
