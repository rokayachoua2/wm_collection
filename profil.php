<?php
// fichier: profil.php
include("includes/config.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id"));
$commandes = mysqli_query($conn, "SELECT * FROM commandes WHERE user_id = $user_id ORDER BY date_commande DESC");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Compte</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5">
  <h2 class="mb-4">Bienvenue, <?= $user['nom'] ?> !</h2>
  <p><strong>Email:</strong> <?= $user['email'] ?></p>
  <p><strong>Téléphone:</strong> <?= $user['telephone'] ?></p>
  <p><strong>Adresse:</strong> <?= $user['adresse'] ?></p>
  <p><strong>Crédit:</strong> <?= number_format($user['credit_client'], 2) ?> DH</p>

  <hr>
  <h4>Mes Commandes</h4>
  <?php if (mysqli_num_rows($commandes) == 0) echo "<p>Aucune commande.</p>"; ?>
  <ul class="list-group">
    <?php while ($cmd = mysqli_fetch_assoc($commandes)) { ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
  <div>
    <strong>Commande #<?= $cmd['id'] ?></strong><br>
    Date: <?= date('d/m/Y', strtotime($cmd['date_commande'])) ?><br>
    Statut: <span class="badge bg-secondary"><?= $cmd['stat'] ?></span><br>
    Paiement: 
    <?php if ($cmd['paiement'] === 'Payé') : ?>
      <span class="badge bg-success">✅ Payé</span>
    <?php else : ?>
      <span class="badge bg-warning text-dark">⏳ Non payé</span>
    <?php endif; ?>
  </div>
</li>

    <?php } ?>
  </ul>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>