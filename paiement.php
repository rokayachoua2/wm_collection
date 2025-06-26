<?php
// fichier: paiement.php
include("includes/config.php");
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['commande_id'])) {
    header("Location: home.php");
    exit;
}

$commande_id = $_SESSION['commande_id'];
$user_id = $_SESSION['user_id'];

$total = 0;
$res = mysqli_query($conn, "SELECT quantite, prix FROM details_commande WHERE commande_id = $commande_id");
while ($row = mysqli_fetch_assoc($res)) {
    $total += $row['quantite'] * $row['prix'];
}

// Enregistrer le paiement
mysqli_query($conn, "INSERT INTO paiement (id_user, prix) VALUES ($user_id, $total)");

// Vider le panier et supprimer ID commande
unset($_SESSION['panier']);
unset($_SESSION['commande_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Paiement réussi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5 text-center">
  <h2 class="text-success mb-4">Merci pour votre achat !</h2>
  <p>Votre commande a été enregistrée avec succès.</p>
  <a href="home.php" class="btn btn-dark mt-3">Retour à l'accueil</a>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
