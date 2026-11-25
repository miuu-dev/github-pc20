-- 1. Crear la base de datos y seleccionarla
CREATE DATABASE IF NOT EXISTS biblioteca_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE biblioteca_db;

-- 2. Crear la tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Crear la tabla 'libros'
CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    genero ENUM('Ficción', 'No Ficción', 'Ciencia', 'Historia', 'Biografía', 'Otro'),
    `año_publicacion` INT,
    leido BOOLEAN DEFAULT FALSE,
    usuario_id INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_libros_usuario 
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
        ON DELETE CASCADE
);

-- 4. Usuario de referencia
INSERT INTO usuarios (email, nombre, password) VALUES (
    'admin@gmail.com', 
    'admin', 
    '$2y$10$lDvU0Fjei.iQi2VbqM93leeIdSp5ki8D1NSUu.65EaSbdVmRe.b8q'
);

-- 5. Libros de ejemplo
INSERT INTO libros (titulo, autor, genero, `año_publicacion`, leido, usuario_id) 
VALUES 
    ('Cien años de soledad', 'Gabriel García Márquez', 'Ficción', 1967, TRUE, 1),
    ('Breves respuestas a las grandes preguntas', 'Stephen Hawking', 'Ciencia', 2018, FALSE, 1),
    ('Sapiens: De animales a dioses', 'Yuval Noah Harari', 'Historia', 2011, TRUE, 1);