<?php
$host = 'localhost';
$db   = 'bplc';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Modo de error por excepción
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve arrays asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desactiva emulación de consultas preparadas
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}