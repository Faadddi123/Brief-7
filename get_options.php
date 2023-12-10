<?php
// Assuming $conn is a valid database connection
include "./back/connexion/host.php";
$sql2 = "SELECT * FROM category";
$result2 = $conn->query($sql2);

$options = array();

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $options[] = array(
            'id' => $row2['id'],
            'name' => $row2['name']
        );
    }
}

header('Content-Type: application/json');
echo json_encode($options);
?>
