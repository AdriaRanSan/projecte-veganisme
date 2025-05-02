<?php
session_start();
require_once 'includes/connexio.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmacio = $_POST['confirmacio'];

    if ($password !== $confirmacio) {
        $error = "Les contrasenyes no coincideixen.";
    } else {
        $conn = connectaBD();

        // Comprovar si ja existeix aquest correu
        $stmt = $conn->prepare("SELECT id FROM usuaris WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Aquest email ja està registrat.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO usuaris (nom, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $email, $hash]);
            $success = "Usuari registrat correctament. Ja pots iniciar sessió.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/estils.css">
    <title>Registrar-se</title>
</head>
<body>
<h2>Formulari de registre</h2>
<form method="post">
    Nom: <input type="text" name="nom" required><br>
    Email: <input type="email" name="email" required><br>
    Contrasenya: <input type="password" name="password" required><br>
    Confirmar contrasenya: <input type="password" name="confirmacio" required><br>
    <button type="submit">Registrar</button>
</form>

<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
if (isset($success)) {
    echo "<p style='color:green;'>$success</p>";
}
?>

<p><a href="index.php">Tornar a login</a></p>
</body>
</html>