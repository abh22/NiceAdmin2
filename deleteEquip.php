<?php

if (isset($_GET["id"])) {
    $id= $_GET["id"];
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); // Added die() to terminate the script
    }
    $selectIp = "SELECT IPaddress  FROM equipments WHERE id= '$id' ";
    $resultIp = mysqli_query($conn, $selectIp);
    $row = mysqli_fetch_assoc($resultIp);
      $equipIp = $row["IPaddress"];
      echo $equipIp;
    $select = "DELETE  FROM equipments WHERE id='$id'";
    $result = mysqli_query($conn, $select);
    $selectLog = "DELETE  FROM historylog WHERE ip='$equipIp'";
    $resultLog = mysqli_query($conn, $selectLog);
    
    
}
   header("Location: equipments.php");
   exit();

?>