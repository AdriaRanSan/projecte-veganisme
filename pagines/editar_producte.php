<?php
session_start();
require_once '../includes/connexio.php';

if (!isset($_SESSION['usuari_id'])) {
    header("Location: login.php");
    exit;
}

$conn = connectaBD();

// Carregar producte
if (!isset($_GET['id'])) {
    die("ID no especificat.");
}
$stmt = $conn->prepare("SELECT * FROM productes WHERE id = ?");
$stmt->execute([$_GET['id']]);
$producte = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$producte) {
    die("Producte no trobat.");
}

// Carregar categories
$stmt = $conn->query("SELECT id, nom FROM categories ORDER BY nom");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Actualitzar
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $preu = $_POST['preu'];
    $categoria_id = $_POST['categoria'];

    $stmt = $conn->prepare("UPDATE productes SET nom = ?, descripcio = ?, preu = ?, categoria_id = ? WHERE id = ?");
    $stmt->execute([$nom, $descripcio, $preu, $categoria_id, $_GET['id']]);

    header("Location: productes.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/estils.css">
    <title>Editar producte</title>
</head>
<body>
<h2>Editar producte</h2>
 <!-- Formulari per a editar els productes -->
<form method="post">
    Nom: <input type="text" name="nom" value="<?= htmlspecialchars($producte['nom']) ?>" required><br>
    Descripció: <textarea name="descripcio" required><?= htmlspecialchars($producte['descripcio']) ?></textarea><br>
    Preu (€): <input type="number" step="0.01" name="preu" value="<?= $producte['preu'] ?>" required><br>
    Categoria:
    <select name="categoria" required>
        <option value="">-- Selecciona una categoria --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $producte['categoria_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Actualitzar</button>
</form>
<a href="productes.php">Tornar</a>
</body>
</html>