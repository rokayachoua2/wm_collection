<?php
// fichier: supprimer_panier.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $produit_id = isset($_GET['produit_id']) ? intval($_GET['produit_id']) : 0;
    $taille_id = isset($_GET['taille_id']) ? intval($_GET['taille_id']) : 0;

    if (isset($_SESSION['panier'])) {
        foreach ($_SESSION['panier'] as $index => $item) {
            if ($item['produit_id'] === $produit_id && $item['taille_id'] === $taille_id) {
                unset($_SESSION['panier'][$index]);
                // Réindexer le tableau après suppression
                $_SESSION['panier'] = array_values($_SESSION['panier']);
                break;
            }
        }
    }
}

header("Location: panier.php");
exit;
