<?php
// Démarrez la session
session_start();

// Fonction pour ajouter un produit au panier
function addToCart($productId, $productName, $productImage, $productPrice) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // vérifier si le produit existe déjà
    $productIndex = array_search($productId, array_column($_SESSION['cart'], 'id'));
    // augmenter la quantité s'il existe
    if ($productIndex !== false) {
        $_SESSION['cart'][$productIndex]['quantity'] += 1;
    } else {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'image URL' => $productImage,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }
}

// Gérer l'ajout au panier
if (isset($_POST['addToCart'])) {
    $productId = $_POST['id'];
    $productName = $_POST['productName'];
    $productImage = $_POST['img'];
    $productPrice = $_POST['productPrice'];
    addToCart($productId, $productName, $productImage, $productPrice);
}

// Fonction pour valider le panier (simule l'insertion dans la base de données)
function validateCart() {
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Insérez ces données dans la base de données (table commande_produit)
    // Remarque : Cette partie doit être adaptée à votre base de données réelle

    // Réinitialisez le panier dans la session
    $_SESSION['cart'] = [];
}
?>
