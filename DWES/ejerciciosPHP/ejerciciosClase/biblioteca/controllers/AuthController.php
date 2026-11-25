<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private Usuario $usuarioModel;

    public function __construct(PDO $conn) {
        $this->usuarioModel = new Usuario($conn);
    }

    public function registro() {
        $error = '';
        
    }
}