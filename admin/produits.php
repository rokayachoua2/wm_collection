<?php
require_once 'includes/auth.php';
require_once 'includes/config.php';

// جلب المنتجات
$produits = mysqli_query($conn, "SELECT * FROM produits");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits - Détail</title>
    <link rel="stylesheet" href="assets/style.css">
     <style>
        .produits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .produit-card {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 15px;
            color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
        .produit-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        .produit-card h3 {
            color: #f8b400;
            margin: 0;
            font-size: 20px;
        }
        .produit-card p {
            margin: 6px 0;
        }
        .actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .actions a, .actions form button {
            flex: 1;
            padding: 5px;
            text-align: center;
            background-color: #f8b400;
            color: #1e1e1e;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .add-btn {
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
    </style> 
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>WM Admin</h2>
    <ul>
        <li><a href="dashboard.php">📊 Tableau de bord</a></li>
        <li><a href="produits.php" class="active">🛍️ Produits</a></li>
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

<!-- Main -->
<div class="main">
    <h1>🛍️ Liste des Produits</h1>

    <!-- Bouton pour page d'ajout -->
    <a href="ajouter.php" class="add-btn">➕ Ajouter Produit</a>

    <!-- Liste des Produits -->
    <div class="produits-grid">
        <?php while ($p = mysqli_fetch_assoc($produits)) : ?>
        <div class="produit-card">
            <img src="../images/<?= htmlspecialchars($p['image']) ?>" alt="Produit">
            <h3><?= htmlspecialchars($p['nom']) ?></h3>
            <p><strong>Prix:</strong> <?= number_format($p['prix'], 2) ?> MAD</p>
            <p><strong>Stock:</strong> <?= $p['stock'] ?></p>
            <p><strong>Description:</strong><br><?= substr(htmlspecialchars($p['description']), 0, 100) ?>...</p>

            <div class="actions">
                <a href="modifier.php?id=<?= $p['id'] ?>">✏️ Modifier</a>
                <form action="supprimer.php" method="POST" onsubmit="return confirm('Êtes-vous sûr(e) ?');">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                    <button type="submit">🗑️ Supprimer</button>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
