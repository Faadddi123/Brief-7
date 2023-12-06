<?php
  $servername = 'localhost';
  $user = 'root';
  $pass = '123';
  $dbname = 'ELECTROTHMAN';

  // Create connection
  $conn = new mysqli($servername, $user, $pass, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $conn->close();
    // session_start();

    $conn = new mysqli($servername, $user, $pass, $dbname);

    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);

    
  ?>