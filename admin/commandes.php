<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// جلب الطلبات مع المعلومات
$query = "SELECT 
            commandes.id,
            commandes.date_commande,
            users.nom AS client,
            SUM(details_commande.quantite * details_commande.prix) AS total
          FROM commandes
          JOIN users ON commandes.user_id = users.id
          JOIN details_commande ON details_commande.commande_id = commandes.id
          GROUP BY commandes.id, commandes.date_commande, users.nom
          ORDER BY commandes.date_commande DESC";

$commandes = mysqli_query($conn, $query);
if (!$commandes) {
    die('Erreur SQL : ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commandes</title>
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
        select, input[type="radio"] {
            margin-top: 5px;
        }
        .paid {
            color: #28a745;
            font-weight: bold;
        }
        .sidebar ul li a.active {
            background-color: #f8b400;
            color: black;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>WM Admin</h2>
    <ul>
        <li><a href="dashboard.php">📊 Tableau de bord</a></li>
        <li><a href="produits.php">🛍️ Produits</a></li>
        <li><a href="commandes.php" class="active">📦 Commandes</a></li>
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
    <h1>📦 Gestion des Commandes</h1>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Date</th>
                <th>Total (MAD)</th>
                <th>Statut</th>
                <th>Paiement</th>
            </tr>

            <?php while ($cmd = mysqli_fetch_assoc($commandes)) :
                $id = $cmd['id'];
                $extra_q = mysqli_query($conn, "SELECT stat, paiement FROM commandes WHERE id = $id");
                $extra = mysqli_fetch_assoc($extra_q);
            ?>
            <tr>
                <td><?= $id ?></td>
                <td><?= htmlspecialchars($cmd['client']) ?></td>
                <td><?= $cmd['date_commande'] ?></td>
                <td><?= number_format($cmd['total'], 2) ?> MAD</td>

                <!-- STATUT -->
                <td>
                    <form action="update_stat.php" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <select name="stat" onchange="this.form.submit()">
                            <?php
                            $options = ['En attente', 'En cours', 'Expédiée', 'Livrée', 'Annulée'];
                            foreach ($options as $opt) {
                                $selected = ($opt == $extra['stat']) ? 'selected' : '';
                                echo "<option value='$opt' $selected>$opt</option>";
                            }
                            ?>
                        </select>
                    </form>
                </td>

                <!-- PAIEMENT -->
                <td>
                    <?php if ($extra['paiement'] === 'Non payé') : ?>
                        <form action="update_paiement.php" method="POST">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <label>
                                <input type="radio" name="paiement" value="Payé" onchange="this.form.submit()">
                                 Valider Paiement
                            </label>
                        </form>
                    <?php else : ?>
                        <span class="paid">✅ Déjà Payée</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>
