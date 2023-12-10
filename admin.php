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
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/style_admin.css">
  <script src="https://cdn.tailwindcss.com/"></script>
 
  <!-- <script src="tailwind.config.js"></script> -->
</head>

<body>
<?php
require './back/connexion/host.php';

if (isset($_POST["Supp"])) {
  $id = isset($_POST["Supp"]) ? $_POST["Supp"] : null;

  if ($id !== null) {
    $sql1 = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql1) === TRUE) {
      // Successfully deleted the record
    } else {
      echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
  } else {
    echo "Invalid user ID";
  }
}

$selectedRole = "Unverified";

if (isset($_POST["role"])) {
  $selectedRole = $_POST["role"];
  $userId = isset($_POST["userId"]) ? $_POST["userId"] : "";
  echo "<h1>Selected Role: $selectedRole</h1>";

  if (!empty($userId)) {
    $sql2 = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
      $sql3 = "UPDATE users SET type = ? WHERE id = $userId";

      $stmt = $conn->prepare($sql3);

      $stmt->bind_param("s", $selectedRole);

      $result = $stmt->execute();

      if ($result) {
        echo "<p>Update successful.</p>";
      } else {
        echo "<p>Error updating the database.</p>";
      }

      $stmt->close();
    } else {
      echo "<p>User not found.</p>";
    }
  } else {
    echo "<p>No user ID provided.</p>";
  }
} else {
  echo '';
}
include('header.php');
?>
  
  <div class="bg-gray-50 min-h-screen" id="content">

    <div>
      <div class="p-4">
        <div class="bg-white p-4 rounded-md">
          <div>
            <h2 class="mb-4 text-xl font-bold text-gray-700">Admin & User</h2>
            <table class="table-auto w-full ">
              <thead class="justify-between bg-gradient-to-tr from-indigo-600 to-purple-600 rounded-md py-2 px-4 text-white font-bold text-md w-full" >
                <tr class="rounded-md" > 
                  <th class="px-4 py-2">Name</th>
                  <th class="px-4 py-2">Email</th>
                  <th class="px-4 py-2">Role</th>
                  <th class="px-4 py-2">Phone</th>
                  <th class="px-4 py-2">Edit</th>
                </tr>
              </thead>
              <tbody>
                <form method="post">
                <?php
                $sql4 = "SELECT * FROM users";
                $result = $conn->query($sql4);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <tr>
                        <td class="border px-4 py-2">'.$row["username"].'</td>
                        <td class="border px-4 py-2">'.$row["email"].'</td>
                        <td class="border px-4 py-2">'.$row["type"].'</td>
                        <td class="border px-4 py-2">'.$row["phone"].'</td>
                        <td class="border px-4 py-2 flex justify-evenly">
                          <select id="roleSelect' . $row["id"] . ' value="' . $row["id"] . '"" name="role" data-user-id="' . $row["id"] . '">
                            <option value="Unverified">Unverified</option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                          
                          </select>
                          <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                          </svg>

                          <button class="text-sm" name="Supp" value="' . $row['id'] . '">Supprimer</button>
                      </div>
                        </td>
                        </tr>
                    ';
                  }
                }
                ?>
                </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
    include('footer.php');
  ?>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="roleselect.js"></script>

</body>

</html>
<?php }
