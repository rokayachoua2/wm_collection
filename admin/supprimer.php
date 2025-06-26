<?php
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // حذف الصورة المرتبطة بالمنتج
    $res = mysqli_query($conn, "SELECT image FROM produits WHERE id = $id");
    $row = mysqli_fetch_assoc($res);
    if ($row && file_exists("../images/" . $row['image'])) {
        unlink("../images/" . $row['image']);
    }

    // حذف المنتج
    mysqli_query($conn, "DELETE FROM produits WHERE id = $id");

    header('Location: produits.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">

</head>
<body>
    <div class="sidebar">
    <h2>WM Admin</h2>
    <ul>
        <li><a href="dashboard.php">📊 Tableau de bord</a></li>
        <li><a href="produits.php" class="active">🛍️ Produits</a></li>
        <li><a href="commandes.php">📦 Commandes</a></li>
        <li><a href="entrees_stock.php">📥 Stock</a></li>
        <li><a href="users.php">👥 Utilisateurs</a></li>
        <li><a href="paiement.php">💳 Paiements</a></li>
        <li><a href="tailles.php">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>
</body>
</html>