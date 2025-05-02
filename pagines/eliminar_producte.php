<?php
session_start();
require_once '../includes/connexio.php';

if (!isset($_SESSION['usuari_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $conn = connectaBD();
    $stmt = $conn->prepare("DELETE FROM productes WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: productes.php");
exit;
?>