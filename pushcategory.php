<?php
    session_start(); 
    require 'back/connexion/host.php';
    if(!isset($_SESSION['admin'])){
      header('location:sign.php?error=sdlkfjsldkjf');
    }
    else{

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com/"></script>
    <title>Document</title>
</head>
<body>
  <?php 
  include "./back/connexion/host.php";
  $category = "";
  $description = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_FILES['imageToUpload'])) {
      $nameimage = $_FILES['imageToUpload']['name'];
  }
  
  else {
      echo "image not found!";
  }
  
      $description = $_POST["descritpion"];
      $category = $_POST["category"];
      if ($category == "" && empty($nameimage) && $description == "") {
        echo 'error';
    } else if ($category != "" && !empty($nameimage) && $description != "") {
        move_uploaded_file($_FILES['imageToUpload']['tmp_name'], "assets/image_category/" . $_FILES['imageToUpload']['name']);
    
        // Insert the data into the MySQLi table
        $sql = "INSERT INTO category (name, image , description) VALUES ('$category', '$nameimage' , '$description')";
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo 'error';
    }
  }
  include('header.php');
  
  ?>
    
      </div>
      <section class="py-10 bg-gray-100">
        <div class="mx-auto grid max-w-6x gap-6 p-6 w-96">
      <article class="rounded-xl mt-10  bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a href="#">
        <form  method="POST" enctype="multipart/form-data">
          <div class="relative flex items-end overflow-hidden rounded-xl">
          
    
            <input type="file" name="imageToUpload">

    
          
            
          </div>
  
          <div class="mt-10 p-2">
            <div class="flex">
            
            <input class="text-slate-700" name="category" placeholder="name de category"></input>

            <input class="text-slate-700" name="descritpion" placeholder="description here"></input>
            
            </div>
            
  
            <div class="mt-3 flex items-end justify-between">
                
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                <button type="submit" name="submit" value="Submit" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <a  class="text-sm">submit</a>
                </button>
              </div>
            </div>
          </div>
          </form>
        </a>
      </article>
      </div>
      </section>
    
</body>
</html>
<?php }
