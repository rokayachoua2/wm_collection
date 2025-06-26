<?php
// fichier: inscription.php
include("includes/config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $erreur = "Cet email est déjà utilisé.";
    } else {
        mysqli_query($conn, "INSERT INTO users (nom, email, password, telephone, adresse) 
                        VALUES ('$nom', '$email', '$password', '$telephone', '$adresse')");
        header("Location: connexion.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5">
    <h2 class="mb-4">Créer un compte</h2>
    <?php if (isset($erreur)) echo "<div class='alert alert-danger'>$erreur</div>"; ?>
    <form method="post">
        <input type="text" name="nom" class="form-control mb-3" placeholder="Nom complet" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe" required>
        <input type="text" name="telephone" class="form-control mb-3" placeholder="Téléphone">
        <textarea name="adresse" class="form-control mb-3" placeholder="Adresse"></textarea>
        <button type="submit" class="btn btn-dark">S'inscrire</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
