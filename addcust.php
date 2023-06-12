
<?php


    
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); 
    }
    $type = $_POST['type'];
    $name = $_POST['name']; 
    $email = $_POST['email'];
    $number=$_POST['tel'];
    $address=$_POST['address'];
    
    $password = md5($_POST['password']);

    $select = "SELECT * FROM registration WHERE password='$password'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) ==0) {
        echo "Password does not match";
    } else {
        $insert = "INSERT INTO customers (type, name, email,num,address) VALUES ('$type', '$name', '$email','$number','$address')";
        $result=mysqli_query($conn, $insert);
        if(!$result){
            echo "invalid query";
            
        }
        
        echo "<script>
        alert('Added customer');
        window.location.href='customers.php';
        </script>";
       
        exit();
    }

?>