<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// جلب المستخدمين لي عندهم role = client
$clients = mysqli_query($conn, "SELECT * FROM users WHERE role = 'client'");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .table-container {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1e1e1e;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #333;
            text-align: left;
        }
        th {
            background-color: #292929;
            color: #f8b400;
        }
        tr:hover {
            background-color: #2c2c2c;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>WM Admin</h2>
    <ul>
        <li><a href="dashboard.php">📊 Tableau de bord</a></li>
        <li><a href="produits.php">🛍️ Produits</a></li>
        <li><a href="commandes.php">📦 Commandes</a></li>
        <li><a href="stock.php">📥 Stock</a></li>
        <li><a href="users.php" class="active">👥 Utilisateurs</a></li>
        <li><a href="paiement.php">💳 Paiements</a></li>
        <li><a href="tailles.php">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>

<div class="main">
    <h1>👥 Gestion des Utilisateurs (Clients)</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date</th>
            </tr>
            <?php while ($client = mysqli_fetch_assoc($clients)) : ?>
            <tr>
                <td><?= $client['id'] ?></td>
                <td><?= $client['nom'] ?></td>
                <td><?= $client['email'] ?></td>
                <td><?= $client['telephone'] ?></td>
                <td><?= $client['date_inscription'] ?? '' ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
