<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

if (!$conn) {
    die("Connexion échouée !");
}

// جلب جميع عمليات الدفع
// $paiements = mysqli_query($conn, "
//     SELECT p.id, p.prix, u.nom AS client, p.date_paiement
//     FROM paiement p
//     JOIN users u ON p.user_id = u.id
//     ORDER BY p.date_paiement DESC
// ");

// $paiements = mysqli_query($conn, "
//     SELECT p.id, p.prix, u.nom AS client
//     FROM paiement p
//     JOIN users u ON p.id_user = u.id
//     ORDER BY p.id DESC
// ");


$paiements = mysqli_query($conn, "
    SELECT p.id, p.prix, u.nom AS client, NOW() AS date_paiement
    FROM paiement p
    JOIN users u ON p.id_user = u.id
    ORDER BY p.id DESC
");



if (!$paiements) {
    die("Erreur SQL : " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiements</title>
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
        <li><a href="clients.php">👥 Utilisateurs</a></li>
        <li><a href="paiement.php" class="active">💳 Paiements</a></li>
        <li><a href="tailles.php">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>

<div class="main">
    <h1>💳 Gestion des Paiements</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Montant (MAD)</th>
                <th>Date</th>
            </tr>
            <?php while ($p = mysqli_fetch_assoc($paiements)) : ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= $p['client'] ?></td>
                <td><?= number_format($p['prix'], 2) ?></td>
                <td><?= $p['date_paiement'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
