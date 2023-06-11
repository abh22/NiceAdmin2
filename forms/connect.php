
<?php
session_start();
$_SESSION['success'] = "";
if (isset($_POST['create'])) {
    $conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); // Added die() to terminate the script
    }
    $name = $_POST['name'];
    $email = mysqli_real_escape_string($conn, $_POST['email']); // $conn variable is not defined
    $username = $_POST['username'];
    $password = ($_POST['password']);
    $cpassword = ($_POST['cpassword']);

   

    $select = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!'; // Removed semicolon (;) inside the string
    } elseif ($password != $cpassword) {
        $error[] = "Password does not match";
    } else {
        $pass=md5($password);
        $insert = "INSERT INTO registration (name, email, username, password) VALUES ('$name', '$email', '$username', '$pass')";
        mysqli_query($conn, $insert);
         // Storing username of the logged in user,
        // in the session variable
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
         
        // Welcome message
        $_SESSION['success'] = $username . 'You have logged in';
        header("Location: index.php");
        exit();
    }
}
?>
