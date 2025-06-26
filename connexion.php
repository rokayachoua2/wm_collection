<?php
// fichier: connexion.php
include("includes/config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // جلب المستخدم حسب البريد الإلكتروني
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($res);

    // تحقق من وجود المستخدم وكلمة السر
    if ($user && $user['password'] === $password) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_role'] = $user['role'];

        // تحويل حسب الدور
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: home.php");
        }
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("includes/nav.php"); ?>
<div class="container py-5">
    <h2 class="mb-4">Connexion</h2>
    <?php if (isset($erreur)) echo "<div class='alert alert-danger'>$erreur</div>"; ?>
    <form method="post">
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe" required>
        <button type="submit" class="btn btn-dark">Se connecter</button>
    </form>
</div>
<?php include("includes/footer.php"); ?>
</body>
</html>
