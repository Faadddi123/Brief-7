<?php
session_start();
require 'back/connexion/host.php';

// Vérifiez si l'ID du produit est passé en tant que paramètre GET
if (isset($_GET['id'])) {
    $user_id = "";
    $id_com = "";
    $dateActuelle = date("Y-m-d H:i:s");
    $productId = $_GET['id'];

    $pro_infos = "SELECT * FROM product WHERE id = $productId";
    $result = mysqli_query($conn, $pro_infos);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $qntity = 1;
            $prix = $row['new_price'];
            $prix_total = $row['new_price'] * $qntity;
        }
    } else {
        die("Échec " . mysqli_error($conn));
    }

    if ($_SESSION['user']) {
        $user_id = $_SESSION['user'];
    } elseif ($_SESSION['admin']) {
        $user_id = $_SESSION['admin'];
    }

    // Vérifiez l'existence de la commande
    $verifier_existance_commande = "SELECT * FROM commande WHERE idclient = $user_id AND etat LIKE '%EN attente%'";
    $resu = mysqli_query($conn, $verifier_existance_commande);

    if (!$resu || mysqli_num_rows($resu) == 0) {
        // une nouvelle commande
        $query = "INSERT INTO commande (date_creation, date_envoi, date_livraison, prix_total, idclient, etat) VALUES ('$dateActuelle', NULL, NULL, '$prix_total', '$user_id', 'EN attente')";
        $inserer_commande = mysqli_query($conn, $query);

        if (!$inserer_commande) {
            die("Échec lors de l'insertion dans la table 'commande': " . mysqli_error($conn));
        }

        // id de la nouvelle commande
        $id_com = mysqli_insert_id($conn);
    } else {
        // Une commande en attente existe déjà, récupérez son ID
        $row = mysqli_fetch_assoc($resu);
        $id_com = $row['idcom'];
    }

    // Insérer dans la table commande_produit
    $query2 = "INSERT INTO commande_produit (idcom, idproduit, quantite, prix_unitaire, prix_total) VALUES ('$id_com', '$id', '$qntity', '$prix', '$prix_total')";
    $inserer_commande_pro = mysqli_query($conn, $query2);

    if ($inserer_commande_pro === false) {
        die("Échec lors de l'insertion dans la table 'commande_produit': " . mysqli_error($conn));
    }
    header('Location: index.php');
    exit;
}

 // remove product from cart
    
 if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $delete_from_cart = "DELETE FROM commande_produit WHERE idproduit = '$id'";
    $result = mysqli_query($conn, $delete_from_cart);
    if ($result) {
        header('Location: index.php');
    }else{
        die("Connection failed: " . $conn->connect_error);
    }
 }



// modifier quantite produit


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $new_quantity = $_POST['quantity'];
        $update_quantity_query = "UPDATE commande_produit SET quantite = $new_quantity ,prix_total = prix_unitaire*$new_quantity WHERE idproduit = '$product_id'";
        $result = mysqli_query($conn, $update_quantity_query);

        if ($result) {
            // Quantity updated successfully
            header('Location: index.php'); // Redirect to the same page or update the cart dynamically using JavaScript
            exit;
        } else {
            // Handle the update failure
            echo "Failed to update quantity: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid parameters for quantity update.";
    }
} else {
    echo "Invalid request method.";
}


?>
