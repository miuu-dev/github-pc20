CREATE DATABASE IF NOT EXISTS flaskcontacts;
USE flaskcontacts;

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(100)
);