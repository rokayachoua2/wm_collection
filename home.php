<?php
// fichier: home.php
include("includes/config.php");
session_start();

// جلب جميع المنتجات
$result = mysqli_query($conn, "SELECT * FROM 	produits");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - WM Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("includes/nav.php"); ?>
<!-- HEADER -->
<header class="text-center text-white custom-header d-flex align-items-center justify-content-center">
    <div class="container">
        <h1 class="display-3">Bienvenue chez WM Collection</h1>
        <p class="lead">Découvrez nos meilleurs produits</p>
    </div>
</header>

<div class="container py-5">
    <h2 class="text-center mb-4">Nos Produits</h2>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="images/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['nom'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['nom'] ?></h5>
                        <p class="card-text"><?= number_format($row['prix'], 2) ?> DH</p>
                        <a href="produit.php?id=<?= $row['id'] ?>" class="btn btn-dark">Voir détails</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>

</body>
</html>
