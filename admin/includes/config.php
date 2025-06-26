<?php
$conn = mysqli_connect("localhost", "root", "", "wmcollection");
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>
