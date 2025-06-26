<?php
// fichier: ajouter_panier.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produit_id = intval($_POST['produit_id']);
    $taille_id = intval($_POST['taille_id']);
    $quantite = intval($_POST['quantite']);

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // vérifier si ce produit avec la même taille est déjà dans le panier
    $found = false;
    foreach ($_SESSION['panier'] as &$item) {
        if ($item['produit_id'] === $produit_id && $item['taille_id'] === $taille_id) {
            $item['quantite'] += $quantite;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $_SESSION['panier'][] = [
            'produit_id' => $produit_id,
            'taille_id' => $taille_id,
            'quantite' => $quantite
        ];
    }
}

header("Location: panier.php");
exit;
