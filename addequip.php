
<?php


    
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); 
    }
    $type = $_POST['type'];
    $brand = $_POST['brand']; 
    $model = $_POST['model'];
    $client= $_POST['client'];
    $password = md5($_POST['password']);

    $select = "SELECT * FROM registration WHERE password='$password'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) ==0) {
        echo "Password does not match";
    } else {
        $insert = "INSERT INTO equipments (type, brand, model, client) VALUES ('$type', '$brand', '$model', '$client')";
        $result=mysqli_query($conn, $insert);
        if(!$result){
            echo "invalid query";
            
        }
        
        echo "<script>
        alert('Added equipment');
        window.location.href='equipments.php';
        </script>";
       
        exit();
    }

?>