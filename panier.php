<?php
// fichier: panier.php
include("includes/config.php");
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$panier = $_SESSION['panier'];
$total = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5">
    <h2 class="mb-4">Votre panier</h2>
    <?php if (empty($panier)) { ?>
        <div class="alert alert-info">Votre panier est vide.</div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Taille</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $index => $item) {
                    $stmt = mysqli_prepare($conn, "SELECT nom, prix, image FROM produits WHERE id = ?");
                    mysqli_stmt_bind_param($stmt, "i", $item['produit_id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $produit = mysqli_fetch_assoc($result);

                    $stmtTaille = mysqli_prepare($conn, "SELECT nom FROM tailles WHERE id = ?");
                    mysqli_stmt_bind_param($stmtTaille, "i", $item['taille_id']);
                    mysqli_stmt_execute($stmtTaille);
                    $resTaille = mysqli_stmt_get_result($stmtTaille);
                    $taille = mysqli_fetch_assoc($resTaille);

                    $sous_total = $produit['prix'] * $item['quantite'];
                    $total += $sous_total;
                ?>
                <tr>
                    <td>
                        <img src="images/<?= $produit['image'] ?>" width="60"> <br>
                        <?= $produit['nom'] ?>
                    </td>
                    <td><?= $taille['nom'] ?></td>
                    <td><?= $item['quantite'] ?></td>
                    <td><?= number_format($produit['prix'], 2) ?> DH</td>
                    <td><?= number_format($sous_total, 2) ?> DH</td>
                    <td><a href="supprimer_panier.php?index=<?= $index ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total: <?= number_format($total, 2) ?> DH</h4>
            <a href="commande.php" class="btn btn-success">Valider la commande</a>
            <a href="supprimer_panier.php?produit_id=<?= $item['produit_id'] ?>&taille_id=<?= $item['taille_id'] ?>"class="btn btn-success">Supprimer</a>

        </div>
    <?php } ?>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>