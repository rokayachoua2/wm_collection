<?php
// fichier: produit.php
include("includes/config.php");
session_start();

if (!isset($_GET['id'])) {
    die("Produit introuvable.");
}

$id = intval($_GET['id']);
$stmt = mysqli_prepare($conn, "SELECT * FROM produits WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$produit = mysqli_fetch_assoc($result);

$tailles = mysqli_query($conn, "
    SELECT t.id, t.nom FROM produit_taille pt 
    JOIN tailles t ON pt.taille_id = t.id 
    WHERE pt.produit_id = $id
");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $produit['nom'] ?> - Détails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="images/<?= $produit['image'] ?>" class="img-fluid rounded shadow-sm" alt="<?= $produit['nom'] ?>">
        </div>
        <div class="col-md-6">
            <h2><?= $produit['nom'] ?></h2>
            <p class="text-muted"><?= number_format($produit['prix'], 2) ?> DH</p>
            <p><?= $produit['description'] ?></p>
            <form action="ajouter_panier.php" method="post">
                <input type="hidden" name="produit_id" value="<?= $produit['id'] ?>">
                <div class="mb-3">
                    <label for="taille" class="form-label">Taille</label>
                    <select name="taille_id" id="taille" class="form-select" required>
                        <?php while ($taille = mysqli_fetch_assoc($tailles)) { ?>
                            <option value="<?= $taille['id'] ?>"><?= $taille['nom'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" name="quantite" id="quantite" value="1" min="1" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-dark">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>