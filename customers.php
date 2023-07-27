<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="header.html">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
      $(function(){
        $("#header").load("header.html");
        $("#side").load("sidebar.html");
        $("#rightside").load("rightside.html");
        $("#footer").load("footer.html");
      });
    </script>
</head>
<body>
    <div id="header"></div>
  <div id="side"></div>
  <main id="main" class="main">
    
  <div class="pagetitle">
      
      <h1>Dashboard</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
  
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
              
            <!-- customers Card -->
            <?php
$conn = new mysqli('localhost', 'root', '', 'stage01');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Read all rows from the database table
$sql = "SELECT * FROM customers";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}
?>

<div class="row">
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card customers-card" id="cust">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Edit</h6>
                        </li>
                        
                        <li><a class="dropdown-item" href="updateCust.php?id=<?php echo $row['id']?>" >Update info</a></li>

                        <li><a style="color: rgb(191, 4, 4);" class="dropdown-item" href="#" name="delete" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</a></li>
                    
                  </ul>
                </div>
                <a href="./customers.html" target="_blank">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?> <span>| <?php echo $row['address']; ?></span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <span class="text-success small pt-1 fw-bold">Contact</span>
                                <span style="font-weight: 600;" class="text-muted small pt-2 ps-1"><?php echo $row['email']; ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
   
    <script>
    function confirmDelete(id) {
      var password = prompt("Please enter the password:");
        if (password !== null) {
        
            // Create a hidden form dynamically
            var form = document.createElement('form');
            form.action = 'deleteCust.php';
            form.method = 'POST';

            // Create a hidden input field for the ID
            var idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = id;
//create pass input
var passwordInput = document.createElement('input');
            passwordInput.type = 'hidden';
            passwordInput.name = 'password';
            passwordInput.value = password;
            // Append the input field to the form
            form.appendChild(idInput);
            form.appendChild(passwordInput);

            // Append the form to the document body
            document.body.appendChild(form);

            // Submit the form
            form.submit();
        }
    }
</script>

</div>

<?php
// Close the connection
$conn->close();
?>

                
                  
                  <!-- End customers Card -->
                  
                  
            </div>
          </div>
          <div class="col-lg-4">
            
            <div id="rightside"></div>
          </div> 
        </div>
    </section>
    </main>
    <div class="col-lg-8">
    <div id="footer"></div></div>
</body>
</html>