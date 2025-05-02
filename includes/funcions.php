<?php
require_once 'connexio.php';

function obtenirProductes() {
    $conn = connectaBD();
    $stmt = $conn->prepare("SELECT * FROM productes");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>