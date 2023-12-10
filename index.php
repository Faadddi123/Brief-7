<?php
session_start(); 
    require 'back/connexion/host.php';
    if(!isset($_SESSION['user'])&&!isset($_SESSION['admin'])){
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
 

    
    <!-- component -->
 
    <!-- Create By Joker Banny -->
    <body class="bg-white">
    
        <!-- Header Navbar -->
        <?php 
        require 'header.php';
        
        ?>
 
 
        <!-- Title -->
        <div class="pt-32  bg-white">
            <h1 class="text-center text-2xl font-bold text-gray-800">Categories</h1>
        </div>
 
        <!-- Tab Menu -->
       
          <div id="filter" class="flex flex-wrap items-center overflow-x-auto overflow-y-hidden py-10 justify-center bg-white text-gray-800">
          <button id="foudi" rel="noopener noreferrer" name="category" value="0" class="foudi flex items-center flex-shrink-0 px-5 py-3 space-x-2 text-gray-600">

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                  <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
              </svg>
              <span>ALL</span>
          </button>
          <?php
        //   $gat = "SELECT * FROM category";
        //   $sum_cate = $conn->query($gat);

        //         if ($sum_cate->num_rows > 0) {
        //             while (($cate = $sum_cate->fetch_assoc())) {
        //                 echo '
        //                 <button rel="noopener noreferrer" name="category" value="' . $cate["id"] . '" class=" foudi flex items-center flex-shrink-0 px-5 py-3 space-x-2 rounded-t-lg text-gray-900">
        //                     <input type="hidden" name="selected_category" value="' . $cate["id"] . '">
        //                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
        //                         <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
        //                         <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
        //                     </svg>
        //                     <span>' . $cate["name"] . '</span>
        //                 </button>
        //                 ';
        //             }
        //         }
                ?>
            </div>
            
              <div class="flex">
                <div class="mr-5">Trier par prix</div>
                <input id="inTprice" class="border-4" type="number" placeholder="low than" name="Tprice">
              </div>
              <button id="butTprice" type="submit">Filter</button>
              
 
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input tybe = "text" name  ="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="SearchText" placeholder="Search Mockups, Logos..." >
        <button type="submit" name = "sendsearch" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="Search">Search</button>
    </div>



            <!-- Product List -->
            <section class="py-10 bg-gray-100">
                <div class="mx-auto grid max-w-6xl product-menu grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
 
                <?php
                    // $page = 1;
                    // $offset = 0;
                    // $pageSize = 4;
                    // $category = 0;
                    // //$product = "Arduino";
                    // if(isset($_POST["Tprice"])){
                    //   $Tprice = $_POST["Tprice"];
                      
                      
                    // }else{
                    //   $Tprice = 9999;
                    // }
                   
                    
                    
 
                    // Check if the "page" button is pressed
                    // if (isset($_POST["page"])) {
                    //   $page = intval($_POST["page"]);
                    //   $_SESSION["page"] = $page;
                    // } else {
                    //   // If "category" key is not set in $_POST, check if it's set in the session
                    //   if (isset($_SESSION["page"])) {
                    //       $page = $_SESSION["page"];
                    //   }
                    // }

                    // // Check if the "category" key is set in the $_POST array
                    // if (isset($_POST["category"])) {
                    //   $category = intval($_POST["category"]);
                    //   $_SESSION["category"] = $category;
                    // } else {
                    //   // If "category" key is not set in $_POST, check if it's set in the session
                    //   if (isset($_SESSION["category"])) {
                    //       $category = $_SESSION["category"];
                    //   }
                    // }



                    
                    // if ($page > 1) {
                    //     $index = $page - 1;
                    //     $offset = ($index * $pageSize);
                    // }
 
 
 
                //     $sql = "SELECT * FROM product";
                //     $counterSql = "SELECT count(*) as count FROM product";
                //      if(isset($_POST['sendsearch'])){
                //          $product = $_POST['search'];
                        
                //        $Tprice = 0;
                //        $category = 0;
                //        $offset = 0;
                // //         
                // $sql = $sql . " WHERE name = '$product' ";
                // $counterSql = $counterSql . " WHERE name = '$product' ";
                  
                //    }
                
                //     if ($Tprice && $category ) {
                //         $sql = $sql . " WHERE new_price < $Tprice AND category = $category ";
                //         $counterSql = $counterSql . " WHERE new_price < $Tprice AND category = $category ";
                //     } else if ($Tprice) {
                //         $sql = $sql . " WHERE new_price < $Tprice ";
                //         $counterSql = $counterSql . " WHERE new_price < $Tprice ";
                //     } else if ($category) {
                //         $sql = $sql . " WHERE category = $category ";
                //         $counterSql = $counterSql . " WHERE category = $category ";
                //     }
                    
                 
                    // if ($category > 0) {
                    //     $sql = $sql . "  WHERE category = $category";
                    //     $counterSql = $counterSql . "  WHERE category = $category";
                    // }
                     
                    // $result = $conn->query($counterSql);
                    
                    // $row = $result->fetch_assoc();
                    // $totalMatchingProducts = intval($row["count"]);
                    // $sql = $sql . " LIMIT $pageSize OFFSET $offset";
                    // $result = $conn->query($sql);
                   
                    // $totalPossiblePages = ceil($totalMatchingProducts / $pageSize);
                    // if ($result->num_rows > 0) {
                    //     while (($row = $result->fetch_assoc())) {
                    ?>
                            <!-- <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 ">
                                <a >
                                <div class="relative flex items-end overflow-hidden rounded-xl">
                                    <img src="assets/image/<?php // echo $row['image']; ?>" alt="Hotel Photo" />
                                </div>
 
                                <div class="mt-1 p-2">
                                    <h2 class="text-slate-700"><?php //echo $row['name']; ?></h2> 
                                    <div class="mt-3 flex items-end justify-between">
                                        <p class="text-lg font-bold text-blue-500">$<?php  //echo $row['new_price'];?></p>
 
                                    <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                        </svg>
 
                                        <a href="action_cart.php?id=<?php //echo $row['id'];?>"><button class="text-sm">Add to cart</button></a>
                                    </div>
                                    </div>
                                </div>
                                </a>
                            </article> -->
                    <?php
                    //     }
                    // }
                    ?>
 
                </div>
                <div id="pagination" class="flex text-center justify-center">
                    <button class="listPagination w-10 bg-white shadow-md space-x-10 m-1 hover:bg-blue-500">100</button>
                </div>
            </section>
      
        

        <!-- produits populaires -->

        <?php 
          include('panier.php');
          include('footer.php');
        ?>

      
 
   
 
   
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
 <script src="pagination.js"></script>
</body>
 
</html>
<?php }; ?>