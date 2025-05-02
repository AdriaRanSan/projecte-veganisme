<?php
session_start();
require_once '../includes/connexio.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = connectaBD();
    $stmt = $conn->prepare("SELECT * FROM usuaris WHERE email = ?");
    $stmt->execute([$email]);
    $usuari = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuari && password_verify($password, $usuari['password'])) {
        $_SESSION['usuari_id'] = $usuari['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Credencials incorrectes.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/estils.css">
    <title>Login</title>
</head>
<body>
<h2>Iniciar sessió</h2>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Contrasenya: <input type="password" name="password" required><br>
    <button type="submit">Entrar</button>
</form>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>