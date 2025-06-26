<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// جلب جميع المقاسات
$tailles = mysqli_query($conn, "SELECT * FROM tailles ORDER BY nom");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tailles</title>
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
        <li><a href="tailles.php" class="active">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>

<div class="main">
    <h1>📏 Gestion des Tailles</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
            </tr>
            <?php while ($t = mysqli_fetch_assoc($tailles)) : ?>
            <tr>
                <td><?= $t['id'] ?></td>
                <td><?= $t['nom'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
