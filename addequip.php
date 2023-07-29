
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the selected value from the form
    if (isset($_POST["type"]) && isset($_POST["brand"])&& isset($_POST["model"]) ) {
       
    
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); 
    }
    $type = $_POST['type'];
    $brand = $_POST['brand']; 
    $model = $_POST['model'];
    $ip=$_POST['ip'];
    $client= $_POST['client'];
    $password = md5($_POST['password']);

    $select = "SELECT * FROM registration WHERE password='$password'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) ==0) {
        echo "Password does not match";
    } else {
        $insert = "INSERT INTO equipments (type, brand, model,IPaddress, client) VALUES ('$type', '$brand', '$model','$ip', '$client')";
        $result=mysqli_query($conn, $insert);
        if(!$result){
            echo "invalid query";
            
        }
        $insertLog = "INSERT INTO historylog (ip) VALUES ('$ip')";
        $resultLog=mysqli_query($conn, $insertLog);
        if(!$resultLog){
            echo "invalid query";}
        echo "<script>
        alert('Added equipment');
        window.location.href='equipments.php';
        </script>";
       
        exit();
    }
    }}
?>