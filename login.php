<?php
echo "hey";

if (isset($_POST['login'])) {
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); 
    }

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    echo $password;
    $select = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) ==0) {
       echo "Wrong credantials, try again!";
        
    } else {
        
        header("Location: index.php");
        exit();
    }
}
?>