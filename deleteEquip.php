<?php

if (isset($_GET["id"])) {
    $id= $_GET["id"];
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); // Added die() to terminate the script
    }
    $select = "DELETE  FROM equipments WHERE id=$id";
    $result = mysqli_query($conn, $select);
    
}
   header("Location: equipments.php");
   exit();

?>