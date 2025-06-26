<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// جلب جميع المسؤولين (admins)
$admins = mysqli_query($conn, "SELECT * FROM users WHERE role = 'admin'");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sécurité & Accès</title>
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
        <li><a href="users.php">👥 Utilisateurs</a></li>
        <li><a href="paiement.php">💳 Paiements</a></li>
        <li><a href="tailles.php">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php" class="active">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>

<div class="main">
    <h1>🛡️ Gestion des Administrateurs</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Téléphone</th>
            </tr>
            <?php while ($a = mysqli_fetch_assoc($admins)) : ?>
            <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['nom'] ?></td>
                <td><?= $a['email'] ?></td>
                <td><?= $a['role'] ?></td>
                <td><?= $a['telephone'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
