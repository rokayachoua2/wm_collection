<?php
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $stat = mysqli_real_escape_string($conn, $_POST['stat']);
    mysqli_query($conn, "UPDATE commandes SET stat = '$stat' WHERE id = $id");
}

header('Location: commandes.php');
exit;
