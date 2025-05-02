<?php
session_start();
require_once '../includes/connexio.php';

if (!isset($_SESSION['usuari_id'])) {
    header("Location: login.php");
    exit;
}

$conn = connectaBD();

// Carregar categories
$stmt = $conn->query("SELECT id, nom FROM categories ORDER BY nom");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $preu = $_POST['preu'];
    $categoria_id = $_POST['categoria'];

    $stmt = $conn->prepare("INSERT INTO productes (nom, descripcio, preu, categoria_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $descripcio, $preu, $categoria_id]);

    header("Location: productes.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/estils.css">
    <title>Afegir producte</title>
</head>
<body>
<h2>Afegir nou producte</h2>
<form method="post">
    Nom: <input type="text" name="nom" required><br>
    Descripció: <textarea name="descripcio" required></textarea><br>
    Preu (€): <input type="number" step="0.01" name="preu" required><br>
    Categoria:
    <select name="categoria" required>
        <option value="">-- Selecciona una categoria --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Guardar</button>
</form>
<a href="productes.php">Tornar</a>
</body>
</html>