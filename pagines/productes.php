<?php
session_start();
require_once '../includes/connexio.php';

if (!isset($_SESSION['usuari_id'])) {
    header("Location: login.php");
    exit;
}

$conn = connectaBD();
//Enllaça els productes en les categories en la BBDD
$stmt = $conn->query("
    SELECT p.id, p.nom, p.descripcio, p.preu, c.nom AS categoria
    FROM productes p
    LEFT JOIN categories c ON p.categoria_id = c.id
    ORDER BY p.nom
");
$productes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/estils.css">
    <title>Llista de productes</title>
</head>
<body>
<h2>Llista de productes vegans</h2>
<a href="afegir_producte.php">Afegir nou producte</a>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Descripció</th>
            <th>Preu</th>
            <th>Categoria</th>
            <th>Accions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Recorreguem la ARRAY per a extraure els datos de la tabla productes -->
        <?php foreach ($productes as $prod): ?>
        <tr>
            <td><?= htmlspecialchars($prod['nom']) ?></td>
            <td><?= htmlspecialchars($prod['descripcio']) ?></td>
            <td><?= number_format($prod['preu'], 2) ?> €</td>
            <td><?= htmlspecialchars($prod['categoria'] ?? 'Sense categoria') ?></td>
            <td>
                <a href="editar_producte.php?id=<?= $prod['id'] ?>">Editar</a> |
                <a href="eliminar_producte.php?id=<?= $prod['id'] ?>" onclick="return confirm('Segur que vols eliminar aquest producte?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="logout.php">Tancar sessió</a>
</body>
</html>