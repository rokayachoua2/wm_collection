<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// تحضير البيانات للإحصائيات: عدد الطلبات لكل شهر
$stats = [];
for ($i = 1; $i <= 12; $i++) {
    $month = str_pad($i, 2, '0', STR_PAD_LEFT);
$res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM commandes WHERE MONTH(date_commande) = '$month'");
    $row = mysqli_fetch_assoc($res);
    $stats[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            margin-top: 30px;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
        }
        canvas {
            background-color: #121212;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
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
    <h1>📈 Statistiques des Commandes / Mois</h1>
    <div class="chart-container">
        <canvas id="commandeChart" width="800" height="400"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('commandeChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
            ],
            datasets: [{
                label: 'Nombre de Commandes',
                data: <?= json_encode($stats) ?>,
                backgroundColor: '#f8b400',
                borderColor: '#f8b400',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#fff' }
                },
                x: {
                    ticks: { color: '#fff' }
                }
            },
            plugins: {
                legend: {
                    labels: { color: '#fff' }
                }
            }
        }
    });
</script>

</body>
</html>
