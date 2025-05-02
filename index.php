<?php
session_start();

if (isset($_SESSION['usuari_id'])) {
    header("Location: pagines/productes.php"); // o dashboard.php
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Benvingut/da a Veganisme</title>
    <link rel="stylesheet" href="css/estils.css">
    <style>
        body {
            text-align: center;
            margin-top: 100px;
            font-family: Arial, sans-serif;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>🌱 Benvingut/da al portal Veganisme</h1>
    <p>Encara no tens compte? <a href="registre.php">Registra’t ara</a></p>
    <p>Ja tens un usuari? <a href="pagines/login.php">Inicia sessió</a></p>
</body>
</html>