<?php
// fichier: commande.php
include("includes/config.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

if (empty($_SESSION['panier'])) {
    header("Location: panier.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    
    mysqli_query($conn, "INSERT INTO commandes (user_id, adresse_livraison) VALUES ($user_id, '$adresse')");
    $commande_id = mysqli_insert_id($conn);

    foreach ($_SESSION['panier'] as $item) {
        $produit_id = $item['produit_id'];
        $taille_id = $item['taille_id'];
        $quantite = $item['quantite'];

        $res = mysqli_query($conn, "SELECT prix FROM produits WHERE id = $produit_id");
        $produit = mysqli_fetch_assoc($res);
        $prix = $produit['prix'];

        mysqli_query($conn, "INSERT INTO details_commande (commande_id, produit_id, quantite, prix, taille_id)
                            VALUES ($commande_id, $produit_id, $quantite, $prix, $taille_id)");
    }

    $_SESSION['commande_id'] = $commande_id;
    header("Location: paiement.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Commande</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5">
  <h2 class="mb-4">Informations de livraison</h2>
  <form method="post">
    <div class="mb-3">
      <label for="adresse" class="form-label">Adresse de livraison</label>
      <textarea name="adresse" id="adresse" rows="4" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Confirmer la commande</button>
  </form>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
