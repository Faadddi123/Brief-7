<?php
require './back/connexion/host.php';
session_start();
$id_pro = $_SESSION['id_pro'];

// -----------------------Modifier Categorie----------------------------------

if (isset($_POST['update'])) {
    $img = $_FILES['imageToUpload']['name'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $new_price = $_POST['new_price'] ;
    $country = $_POST['country'];
    $cat_img_tmp = $_FILES['imageToUpload']['tmp_name'];
    $cat_image_folder = 'assets/image/' . $img;

    $request = "UPDATE product
                SET name = '$name',
                city = '$city',
                country = '$country' ,
                new_price = $new_price , 
                image = '$img'
                WHERE id like '%$id_pro%'";
    
    $stmt = mysqli_query($conn, $request);
    
    if ($stmt) {
        move_uploaded_file($cat_img_tmp, $cat_image_folder);
        header('location: indexadmin.php');
    } else {
        die("Échec de la connexion : " . mysqli_error($conn));
    }
}




  ?>