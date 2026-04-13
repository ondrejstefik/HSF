<?php
require_once __DIR__ . '/../config.php';

// $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn = new mysqli('localhost', 'stefik2026', 'Stefik2026#', 'stefik2026');

if ($conn->connect_error) {
    die('Chyba pripojenia k databáze: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
?>