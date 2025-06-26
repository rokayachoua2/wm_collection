<?php
// fichier: includes/config.php

$host = 'localhost';
$user = 'root';
$password = ''; // إذا كنتِ تستعملي XAMPP وخاصك mdp كتبيه هنا
$dbname = 'wmcollection';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Échec de la connexion à la base de données: " . mysqli_connect_error());
}
?>
