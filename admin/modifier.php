<?php
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header('Location: produits.php');
    exit;
}

$id = intval($_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM produits WHERE id = $id");
$produit = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prix = floatval($_POST['prix']);
    $stock = intval($_POST['stock']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = uniqid() . '_' . $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, '../images/' . $image_name);

        if ($produit['image'] && file_exists("../images/" . $produit['image'])) {
            unlink("../images/" . $produit['image']);
        }

        $query = "UPDATE produits SET nom='$nom', prix=$prix, stock=$stock, description='$description', image='$image_name' WHERE id=$id";
    } else {
        $query = "UPDATE produits SET nom='$nom', prix=$prix, stock=$stock, description='$description' WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        header('Location: produits.php');
        exit;
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Produit</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- === Sidebar === -->
<div class="sidebar">
    <h2>WM Admin</h2>
    <ul>
        <li><a href="dashboard.php">📊 Tableau de bord</a></li>
        <li><a href="produits.php" class="active">🛍️ Produits</a></li>
        <li><a href="commandes.php">📦 Commandes</a></li>
        <li><a href="entrees_stock.php">📥 Stock</a></li>
        <li><a href="users.php">👥 Utilisateurs</a></li>
        <li><a href="paiement.php">💳 Paiements</a></li>
        <li><a href="tailles.php">📏 Tailles</a></li>
        <li><a href="statistiques.php">📈 Statistiques</a></li>
        <li><a href="securite.php">🛡️ Sécurité</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</div>

<!-- === Main content === -->
<div class="main">
    <div class="form-container">
        <h1>✏️ Modifier le produit</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" placeholder="Nom du produit" required>
            <input type="number" step="0.01" name="prix" value="<?= $produit['prix'] ?>" placeholder="Prix" required>
            <input type="number" name="stock" value="<?= $produit['stock'] ?>" placeholder="Stock" required>
            <textarea name="description" placeholder="Description..." required><?= htmlspecialchars($produit['description']) ?></textarea>
            <label>Image actuelle :</label><br>
            <img src="../images/<?= $produit['image'] ?>" alt="Produit" width="150"><br><br>
            <input type="file" name="image"><br><br>
            <button type="submit">💾 Enregistrer</button>
        </form>
    </div>
</div>

</body>
</html>
