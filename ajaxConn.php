<?php
require './back/connexion/host.php';
// $stmt = $conn->prepare('SELECT * FROM categories ');
// $stmt->execute();
// $catgs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $stmt1 = $conn->prepare('SELECT * FROM products');
// $stmt1->execute();
// $product = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// $categories = json_encode($catgs);
// $products = json_encode($product);
$stmt = $conn->prepare('SELECT * FROM category');
$stmt->execute();
$result = $stmt->get_result();
$catgs = $result->fetch_all(MYSQLI_ASSOC);

// Fetch products
$stmt1 = $conn->prepare('SELECT * FROM product');
$stmt1->execute();
$result1 = $stmt1->get_result();
$product = $result1->fetch_all(MYSQLI_ASSOC);

// Encode data to JSON
$categories = json_encode($catgs);
$products = json_encode($product);  

// if (isset($_GET['table'])) {
//     $str = $_GET['table'];
//     echo $$str;
// }

// if (isset($_GET['liveSearch'])) {
//     $search = $_GET['liveSearch'];
//     if ($search != "") {
//         $stmt2 = $conn->prepare("SELECT * FROM products WHERE etiquette LIKE '%$search%'");
//         $stmt2->execute();
//         $searchedProducts = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//         echo json_encode($searchedProducts);
//     }
// }

if (isset($_GET['table'])) {
    $str = $_GET['table'];
    echo $$str;
}

// if (isset($_GET['liveSearch'])) {
//     $search = $_GET['liveSearch'];
//     if ($search != "") {
//         $stmt2 = $conn->prepare("SELECT * FROM products WHERE etiquette LIKE '%$search%'");
//         $stmt2->execute();
//         $result2 = $stmt2->get_result();
//         $searchedProducts = $result2->fetch_all(MYSQLI_ASSOC);
//         echo json_encode($searchedProducts);
//     }
// }



// echo '<pre>';
// print_r($result);
// echo '</pre>';