<?php
session_start();
if (!isset($_SESSION['usuari_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="../css/estils.css">
<html>
<head>
    <title>Panell de control</title>
</head>
<body>
<h1>Benvingut al panell de control</h1>
<ul>
    <li><a href="productes.php">Gestionar productes</a></li>
    <li><a href="logout.php">Tancar sessió</a></li>
</ul>
</body>
</html>