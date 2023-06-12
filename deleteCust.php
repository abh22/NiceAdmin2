<?php
echo "hey";
if (isset($_POST["id"])) {
    $id = $_POST["id"];
   echo $id;
    $password = md5($_POST["password"]);
    echo $password;
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    $selectPass = "SELECT * FROM registration WHERE password = '$password'";
    $resultPass = mysqli_query($conn, $selectPass);
   
    if (mysqli_num_rows($resultPass) == 0) {
        echo "Password does not match";
    } else {
        $select = "DELETE FROM customers WHERE id = '$id'";
        $result = mysqli_query($conn, $select);
        
        if (!$result) {
            echo "Invalid query";
        } else {
            echo "<script>
                alert('Deleted customer');
                window.location.href='customers.php';
                </script>";
        }
    }
    
    exit();
}
?>
