<?php
// fichier: includes/nav.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="home.php">WM Collection</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="home.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="panier.php">Panier</a></li>

        <?php if (isset($_SESSION['user_id'])) { ?>
            <li class="nav-item"><a class="nav-link" href="profil.php">Mon Compte</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
        <?php } else { ?>
            <li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>
            <li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
