<?php
function connectaBD() {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=veganisme;charset=utf8", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Error de connexió: " . $e->getMessage());
    }
}
?>