<?php
session_start();
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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
   
    $password = $_POST["password"];
    if($email == '' || $password == ''){
      echo 'error';
    }
    else{
    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $checkUserResult = $conn->query($checkUserQuery);

    if ($checkUserResult->num_rows === 0) {
        echo '<div class ="absolute mt-20 ">EMail or the password is wrong. Please check. </div>';
        
                                      
    } else if ($checkUserResult->num_rows === 1){
      $row=$checkUserResult->fetch_array();
      
      

        // Set Verified to FALSE by default
        if($row['type']==='user'){
          $_SESSION['user']=$row['id'];
          echo $email;
          header("Location: index.php");
          exit();
        }else if($row['type']==='admin'){
          $_SESSION['admin']=$row['id'];
          header("Location: admin.php");
          exit();
        }else{
          header("Location: sign.php");
          exit();
        }
        
        
    }
  }
}

  ?>
    <!-- header -->
    <?php 
      require 'header.php';
    ?>


<div class="flex items-center min-h-screen bg-white dark:bg-gray-900">
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-10">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200" >Sign in</h1>
                <p class="text-gray-500 dark:text-gray-400">Sign in to access your account</p>
            </div>
            <div class="m-7">
                <form method="post">
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="you@company.com" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password</label>
                            <a href="#!" class="text-sm text-gray-400 focus:outline-none focus:text-indigo-500 hover:text-indigo-500 dark:hover:text-indigo-300">Forgot password?</a>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Your Password" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                    </div>
                    <div class="mb-6">
                        <button type="submit"  class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Sign in</button>
                    </div>
                    <p class="text-sm text-center text-gray-400">Don&#x27;t have an account yet? <a href="signup.php" class="text-indigo-400 focus:outline-none focus:underline focus:text-indigo-500 dark:focus:border-indigo-800">Sign up</a>.</p>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer Mentions -->
<div class="fixed bottom-5 w-full text-center text-gray-400">
	Crafted with ♡ by <a class="text-blue-500" target="_blank" href="https://web3templates.com/components/">Web3Templates</a>
</div>
<script src="https://cdn.tailwindcss.com/"></script>
</body>
</html>