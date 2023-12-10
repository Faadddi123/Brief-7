<?php
session_start(); 
    require 'back/connexion/host.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<body class="bg-white">
    
    <!-- Header Navbar -->
    <?php 
    require 'header.php';
    ?>
    <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full mt-44 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                id
                </th>
                <th scope="col" class="px-6 py-3">
                date creation
                </th>
                <th scope="col" class="px-6 py-3">
                date envoi
                </th>
                <th scope="col" class="px-6 py-3">
                date livraison  
                </th>
                <th scope="col" class="px-6 py-3">
                prix total
                </th>
                <th scope="col" class="px-6 py-3">
                id client
                </th>
                <th scope="col" class="px-6 py-3">
                etat
                </th>
              
                
                <th scope="col" class="px-6 py-3">
                annuler
                </th>
                
                
            </tr>
        </thead>
        <tbody>
          <!-- 
        <td class="px-6 py-4">
               
        </td>
        --->
       <?php
       //idcom, date_creation, date_envoi, date_livraison, prix_total, idclient, etat
       $sql = "SELECT * from commande";
       $sqlrun = mysqli_query($conn,$sql);
       while($row = mysqli_fetch_assoc($sqlrun)){
        
        ?>
        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
          <?=$row['idcom']?>
        </th>
        <td class="px-6 py-4">
             <?=$row['date_creation']?>
        </td>
        <td class="px-6 py-4">
        <?=$row['date_envoi']?>
        </td>
        <td class="px-6 py-4">
            <?=$row['date_livraison']?> 
        </td>
        <td class="px-6 py-4">
        <?=$row['prix_total']?> 
        </td>
        <td class="px-6 py-4">
        <?=$row['idclient']?> 
        </td>
        <td class="px-6 py-4">
        <select name ="category"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                  <option selected="<?=$row['etat']?>"><?=$row['etat']?></option>
                  <option value="en attente"> en attente</option>
                  <option value="en attente"> en cours</option>
                  <option value="en attente"> livré</option>
       </select>
        </td>
       
       <td class="px-6 py-4">
        <form method = 'GET'>
          <button class="bg-blue-500 text-white px-4 py-2 rounded-md "  name ="annuler" value = '<?=$row['idcom']?>'>annuler</button>
        </form>
       </td>
      
    </tr>
    <?php
    }
    if(isset($_GET['annuler'])){
         $selectcom = $_GET['annuler'];
        $sqlselected = "DELETE FROM commande WHERE idcom = '$selectcom'";
        mysqli_query($conn,$sqlselected);
    }
    ?>
       
       
        </tbody>
    </table>
</div>
         
</body>
</html>