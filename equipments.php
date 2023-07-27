<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />
    <link href="header.html" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />

    <script
      src="https://code.jquery.com/jquery-3.7.0.min.js"
      integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
      crossorigin="anonymous"
    ></script>
    <script>
      $(function () {
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
          <li class="breadcrumb-item active">Equipments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
             
<!-- displaying equipments-->
<table class="table" >
  <thead>
<tr>
  <th>ID</th>
  <th>Type</th>
  <th>Brand</th>
  <th>Model</th>
  <th>IP address</th>
  <th>Client</th>

</tr>
</thead>

  <tbody>
      <?php
      $conn = new mysqli('localhost', 'root', '', 'stage01');
      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error); 
      }

     

      // read all row from database table
$sql = "SELECT * FROM equipments";
$result = mysqli_query($conn,$sql);

      if (!$result) {
  die("Invalid query: " . $connection->error);
}

      // read data of each row
while($row = $result->fetch_assoc()) {
          echo "<tr>
              <td>" . $row["id"] . "</td>
              <td>" . $row["type"] . "</td>
              <td>" . $row["brand"] . "</td>
              <td>" . $row["model"] . "</td>
              <td>" . $row["IPaddress"] . "</td>
              <td>" . $row["client"] . "</td>
           
              <td>
                  <a class='btn btn-primary btn-sm' href='updateEquip.php?id=$row[id]'>Update</a>
                  <a class='btn btn-danger btn-sm'  href='deleteEquip.php?id=$row[id]'>Delete</a>
              </td>
          </tr>";
      }

      $conn->close();
      ?>
  </tbody>
</table>
              
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
