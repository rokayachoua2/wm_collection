<?php
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $paiement = mysqli_real_escape_string($conn, $_POST['paiement']);
    mysqli_query($conn, "UPDATE commandes SET paiement = '$paiement' WHERE id = $id");
}

header('Location: commandes.php');
exit;
