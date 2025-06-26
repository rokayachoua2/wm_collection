<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// إحصائيات من قاعدة البيانات
$total_produits = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produits"))['total'];
$total_clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role = 'client'"))['total'];
$total_commandes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM commandes"))['total'];
$total_paiements = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(prix) AS total FROM paiement"))['total'];
$total_paiements = $total_paiements ? number_format($total_paiements, 2) : "0.00";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="sidebar">
    <h2>WM Admin</h2>
    <ul>
        <li><a href="dashboard.php" class="active">📊 Tableau de bord</a></li>
        <li><a href="produits.php">🛍️ Produits</a></li>
        <li><a href="commandes.php">📦 Commandes</a></li>
        <li><a href="stock.php">📥 Stock</a></li>
        <li><a href="users.php">👥 Utilisateurs</a></li>
        <li><a href="paiement.php">💳 Paiements</a></li>
        <li><a href="tailles.php">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>

<div class="main">
    <h1>Bienvenue, <?= $_SESSION['user_nom'] ?> 👋</h1>

    <div class="cards">
        <div class="card"><h3>Total Produits</h3><p><?= $total_produits ?></p></div>
        <div class="card"><h3>Total Clients</h3><p><?= $total_clients ?></p></div>
        <div class="card"><h3>Total Commandes</h3><p><?= $total_commandes ?></p></div>
        <div class="card"><h3>Total Paiements</h3><p><?= $total_paiements ?> MAD</p></div>
    </div>
</div>
</body>
</html>
