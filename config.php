<?php
// config.php
define('DB_HOST', 'localhost'); // Hostinger generalmente usa localhost
define('DB_NAME', 'u955359344_iglesias'); // Reemplaza con tu nombre de BD
define('DB_USER', 'u955359344_mati'); // Reemplaza con tu usuario
define('DB_PASS', 'BlSBf=1234'); // Reemplaza con tu contraseña

try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>