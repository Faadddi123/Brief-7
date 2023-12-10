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
$selectedRole = "arduino";
$name = "";
$city = "";
$country = "";
$new_price = 0;
$nameimage = "";
if (isset($_POST["role"])) {
  $selectedRole = $_POST["role"];
  
  echo "<h1>Selected Role: $selectedRole</h1>";
}
if (isset($_FILES['imageToUpload'])) {
  $nameimage = $_FILES['imageToUpload']['name'];
}

else {
    echo "image not found!";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $new_price = $_POST["new_price"];
    
    if ($name == "" && empty($nameimage) && $city == "" && $country == "" && $new_price == 0) {
      echo 'error';
  }else if($name != "" && !empty($nameimage) && $city != "" && $country != "" && $new_price != 0){
    move_uploaded_file($_FILES['imageToUpload']['tmp_name'], "assets/image/" . $_FILES['imageToUpload']['name']);
    $sql3 = "SELECT id FROM category WHERE name = '$selectedRole'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
  $row3 = $result3->fetch_assoc();
  $id_category = $row3['id'];
} else {
  // Category not found
  $id_category = null;
}

echo $name;echo '<br>'; echo $city;echo '<br>'; echo $country;echo '<br>';  echo $new_price;echo '<br>'; echo $id_category;
    // Insert the data into the MySQLi table
    $sql = "INSERT INTO product (name, new_price , category , city, country,image) VALUES ('$name', '$new_price' , '$id_category' , '$city' , '$country' , '$nameimage')";
    echo $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }else{
    echo 'failed';
  }
}

include('header.php');
?>
      <section class="py-10 bg-gray-100">
                <div id="formContainer" class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
      <article  class="rounded-xl mt-10  bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
        <a >
        <form  method="post" enctype="multipart/form-data">
          <div class="relative flex items-end overflow-hidden rounded-xl">
          
    
            <input type="file" name="imageToUpload">

    
          
            
          </div>
  
          <div class="mt-10 p-2">
            <div class="flex">
            <input class="text-slate-700" placeholder="name" name="name"></input>
            <select id="roleSelect" value="1" name="role" >
            <?php
                $sql2 = "SELECT * FROM category";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                  while ($row2 = $result2->fetch_assoc()) {
                    echo '
                      
                          
                            <option value="' . $row2['name'] . '" id="' . $row["id"] . '">' . $row2['name'] . '</option>
                            
                          
                         
                        
                    ';
                  }
                }
                ?>
      </select>
            
            </div>
            <div class="mt-1 text-sm text-slate-400 flex">
              <input type="text" placeholder="city" name="city"><input type="text" placeholder="country" name="country">
            </div>
  
            <div class="mt-3 flex items-end justify-between">
                <input class="text-lg font-bold text-blue-500 to-blue-500" placeholder="price" name="new_price"></input>
  
              <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-3 py-1.5 text-white duration-100 hover:bg-blue-600">
                <button type="submit" name="submit" value="Submit" class="flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
  
                <a  class="text-sm">submit</a>
                </button>
              </div>
            </div>
                
          </div>
          
        </a>
        </form> 
      </article>
      
      
       
      </div>
      <div class="mx-auto">
      
      </div>
      
      
      </section>
      <button id="plusButton"  name="plus" class="text-white  justify-center object-center justify-self-center bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 w-24 h-24 mt-24">+</button>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script src="pushplus.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="roleselect.js"></script>
</body>
</html>
<?php }