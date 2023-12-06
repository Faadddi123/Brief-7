<?php
require './back/connexion/host.php';
session_start();
$cat_name = $_SESSION['cat_name'];

if (isset($_GET['delete'])) {
    $nom_cat = $_GET['delete'];
    $request = "DELETE FROM category WHERE name like '%$nom_cat%' ";
    $stmt = mysqli_query($conn,$request);  
    if ($stmt) {
        header('location: categories.php');
        } else {
        die("Échec : " . mysqli_error($conn));
        }
}

// -----------------------Modifier Categorie----------------------------------

if (isset($_POST['update'])) {
    $img = $_FILES['imageToUpload']['name'];
    $name = $_POST['catName'];
    $catDescription = $_POST['catDescription'];
    $cat_img_tmp = $_FILES['imageToUpload']['tmp_name'];
    $cat_image_folder = 'assets/img/' . $img;

    $request = "UPDATE category
                SET name = '$name',
                description = '$catDescription',
                image = '$img'
                WHERE name like '%$cat_name%'";
    
    $stmt = mysqli_query($conn, $request);
    
    if ($stmt) {
        move_uploaded_file($cat_img_tmp, $cat_image_folder);
        header('location: categories.php');
    } else {
        die("Échec de la connexion : " . mysqli_error($conn));
    }
}




  ?>