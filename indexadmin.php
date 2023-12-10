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
    require './back/connexion/host.php';
    if(isset($_POST["Supprimer"])){
      $id = intval($_POST["Supprimer"]);
      $supprimer ="DELETE  FROM product WHERE id = $id";
      if ($conn->query($supprimer) === TRUE) {
        header("Location:". $_SERVER["PHP_SELF"]); 
        
        exit();
        

      } else {
          echo "Error: " . $supprimer . "<br>" . $conn->error;
      }
      
    }
    ?>
    <!-- component -->
 
    <!-- Create By Joker Banny -->
 
    <body class="bg-white">
        <!-- Header Navbar -->
<?php include('header.php');?> 
        <!-- Title -->
        <div class="pt-32  bg-white">
            <h1 class="text-center text-2xl font-bold text-gray-800">Categories</h1>
        </div>
 
        <!-- Tab Menu -->
        <form method="post">
            <div class="flex flex-wrap items-center  overflow-x-auto overflow-y-hidden py-10 justify-center   bg-white text-gray-800">
                <button rel="noopener noreferrer" name="category" value="0" class="flex items-center flex-shrink-0 px-5 py-3 space-x-2text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>ALL</span>
                </button>
                <?php 
                $gat = "SELECT * FROM category";
                $sum_cate = $conn->query($gat);
                
                if($sum_cate->num_rows > 0){
                while(($cate = $sum_cate->fetch_assoc())){
                  echo '
                  <button rel="noopener noreferrer" name="category" value="' . $cate["id"] .'" class="flex items-center flex-shrink-0 px-5 py-3 space-x-2 rounded-t-lg text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    <span>' . $cate["name"] .'</span>
                </button>
                  ';
                }
              }
                ?>
                
                <div>
                  <input type="text">
                </div>
            </div>
 
            <!-- Product List -->
            <section class="py-10 bg-gray-100">
                <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
 
                <?php
                    $page = 1;
                    $offset = 0;
                    $pageSize = 4;
                    $category = 0;

                    if(isset($_POST["Tprice"])){
                      $Tprice = $_POST["Tprice"];
                      
                      
                    }else{
                      $Tprice = 9999;
                    }


 
                    // Check if the "page" button is pressed
                    if (isset($_POST["page"])) {
                      $page = intval($_POST["page"]);
                      $_SESSION["page"] = $page;
                    } else {
                      // If "category" key is not set in $_POST, check if it's set in the session
                      if (isset($_SESSION["page"])) {
                          $page = $_SESSION["page"];
                      }
                    }

                    // Check if the "category" key is set in the $_POST array
                    if (isset($_POST["category"])) {
                      $category = intval($_POST["category"]);
                      $_SESSION["category"] = $category;
                    } else {
                      // If "category" key is not set in $_POST, check if it's set in the session
                      if (isset($_SESSION["category"])) {
                          $category = $_SESSION["category"];
                      }
                    }



                    
                    if ($page > 1) {
                        $index = $page - 1;
                        $offset = ($index * $pageSize);
                    }
 
 
 
                    $sql = "SELECT * FROM product";
                    $counterSql = "SELECT count(*) as count FROM product";

                    if ($Tprice && $category) {
                        $sql = $sql . " WHERE new_price < $Tprice AND category = $category ";
                        $counterSql = $counterSql . " WHERE new_price < $Tprice AND category = $category ";
                    } else if ($Tprice) {
                        $sql = $sql . " WHERE new_price < $Tprice ";
                        $counterSql = $counterSql . " WHERE new_price < $Tprice ";
                    } else if ($category) {
                        $sql = $sql . " WHERE category = $category ";
                        $counterSql = $counterSql . " WHERE category = $category ";
                    }

                    // if ($category > 0) {
                    //     $sql = $sql . "  WHERE category = $category";
                    //     $counterSql = $counterSql . "  WHERE category = $category";
                    // }

                    $result = $conn->query($counterSql);
                    $row = $result->fetch_assoc();
                    $totalMatchingProducts = intval($row["count"]);
                    $sql = $sql . " LIMIT $pageSize OFFSET $offset";
                    $result = $conn->query($sql);
                      echo $sql ;
                      echo 'category' . $category ;
 
                    $totalPossiblePages = ceil($totalMatchingProducts / $pageSize);
                    if ($result->num_rows > 0) {
                        while (($row = $result->fetch_assoc())) {
                            echo '
                            <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
                                <a >
                                <div class="relative flex items-end overflow-hidden rounded-xl">
                                    <img src="assets/image/' . $row['image'] . '" alt="Hotel Photo" />
                                    <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
 
                                    <button class="text-sm">Add to cart</button>
                                    </div>
                                </div>
 
                                <div class="mt-1 p-2">
                                    <h2 class="text-slate-700">' . $row['name'] . '</h2>
                                    <p class="mt-1 text-sm text-slate-400">' . $row['city'] . ', ' . $row['country'] . '</p>
 
                                    <div class="mt-3 flex items-end justify-between">
                                        <p class="text-lg font-bold text-blue-500">$' . $row['new_price'] . '</p>
 
                                        <div class="flex">
                                            <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                                            
    
                                            <button class="text-sm" name="Supprimer" value= "' . $row['id'] . '">Sup</button>
                                            </div>
                                            <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                                            
    
                                            <a href="edit_pro.php?edit=' . $row['id'] . '" class="text-sm" name="Modifier" value= "' . $row['id'] . '">Mod</a>
                                            </div>
                                        </div>                                  
                                    </div>
                                </div>
                                </a>
                            </article>
                        ';
                        }
                    }
                    ?>
 
                </div>
                <div class="flex text-center justify-center">
                    <?php
                    $page = 1;
                    while ($page <= $totalPossiblePages) {
                        echo '<button class="w-10 bg-white shadow-md space-x-10 m-1 hover:bg-blue-500" name="page" value="' . $page . '">' . $page . '</button>';
                        $page++;
                    }
                    ?>
                </div>
            </section>
        </form>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
 
    </body>
 
    <footer class="py-6  bg-gray-200 text-gray-900">
      <div class="container px-6 mx-auto space-y-6 divide-y divide-gray-400 md:space-y-12 divide-opacity-50">
          <div class="grid justify-center  lg:justify-between">
              <div class="flex flex-col self-center text-sm text-center md:block lg:col-start-1 md:space-x-6">
                  <span>Copy rgight © 2023 by codemix team </span>
                  <a rel="noopener noreferrer" href="#">
                      <span>Privacy policy</span>
                  </a>
                  <a rel="noopener noreferrer" href="#">
                      <span>Terms of service</span>
                  </a>
              </div>
              
              <div class="flex justify-center pt-4 space-x-4 lg:pt-0 lg:col-end-13">
                  <a rel="noopener noreferrer" href="#" title="Email" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                      </svg>
                  </a>
                  <a rel="noopener noreferrer" href="#" title="Twitter" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" fill="currentColor" class="w-5 h-5">
                          <path d="M 50.0625 10.4375 C 48.214844 11.257813 46.234375 11.808594 44.152344 12.058594 C 46.277344 10.785156 47.910156 8.769531 48.675781 6.371094 C 46.691406 7.546875 44.484375 8.402344 42.144531 8.863281 C 40.269531 6.863281 37.597656 5.617188 34.640625 5.617188 C 28.960938 5.617188 24.355469 10.21875 24.355469 15.898438 C 24.355469 16.703125 24.449219 17.488281 24.625 18.242188 C 16.078125 17.8125 8.503906 13.71875 3.429688 7.496094 C 2.542969 9.019531 2.039063 10.785156 2.039063 12.667969 C 2.039063 16.234375 3.851563 19.382813 6.613281 21.230469 C 4.925781 21.175781 3.339844 20.710938 1.953125 19.941406 C 1.953125 19.984375 1.953125 20.027344 1.953125 20.070313 C 1.953125 25.054688 5.5 29.207031 10.199219 30.15625 C 9.339844 30.390625 8.429688 30.515625 7.492188 30.515625 C 6.828125 30.515625 6.183594 30.453125 5.554688 30.328125 C 6.867188 34.410156 10.664063 37.390625 15.160156 37.472656 C 11.644531 40.230469 7.210938 41.871094 2.390625 41.871094 C 1.558594 41.871094 0.742188 41.824219 -0.0585938 41.726563 C 4.488281 44.648438 9.894531 46.347656 15.703125 46.347656 C 34.617188 46.347656 44.960938 30.679688 44.960938 17.09375 C 44.960938 16.648438 44.949219 16.199219 44.933594 15.761719 C 46.941406 14.3125 48.683594 12.5 50.0625 10.4375 Z"></path>
                      </svg>
                  </a>
                  <a rel="noopener noreferrer" href="#" title="GitHub" class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                          <path d="M10.9,2.1c-4.6,0.5-8.3,4.2-8.8,8.7c-0.5,4.7,2.2,8.9,6.3,10.5C8.7,21.4,9,21.2,9,20.8v-1.6c0,0-0.4,0.1-0.9,0.1 c-1.4,0-2-1.2-2.1-1.9c-0.1-0.4-0.3-0.7-0.6-1C5.1,16.3,5,16.3,5,16.2C5,16,5.3,16,5.4,16c0.6,0,1.1,0.7,1.3,1c0.5,0.8,1.1,1,1.4,1 c0.4,0,0.7-0.1,0.9-0.2c0.1-0.7,0.4-1.4,1-1.8c-2.3-0.5-4-1.8-4-4c0-1.1,0.5-2.2,1.2-3C7.1,8.8,7,8.3,7,7.6C7,7.2,7,6.6,7.3,6 c0,0,1.4,0,2.8,1.3C10.6,7.1,11.3,7,12,7s1.4,0.1,2,0.3C15.3,6,16.8,6,16.8,6C17,6.6,17,7.2,17,7.6c0,0.8-0.1,1.2-0.2,1.4 c0.7,0.8,1.2,1.8,1.2,3c0,2.2-1.7,3.5-4,4c0.6,0.5,1,1.4,1,2.3v2.6c0,0.3,0.3,0.6,0.7,0.5c3.7-1.5,6.3-5.1,6.3-9.3 C22,6.1,16.9,1.4,10.9,2.1z"></path>
                      </svg>
                  </a>
              </div>
          </div>
      </div>
  </footer>
 
</body>
 
</html>
<?php }
