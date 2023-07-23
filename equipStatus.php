<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TT</title>
    
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
  <section class="section dashboard">
  <div class="btn-group-filter">
  <div class="col-lg-4">
   
<div  class="btn-group" role="group" aria-label="Basic example">
  <button type="button"  class="btn btn-primary" id="btnUp" data-toggle="button">UP</button>
  <button type="button"  class="btn btn-secondary" id="btnDown" data-toggle="button" checked>DOWN</button>
 
</div>
<div  class="btn-group" role="group" aria-label="Basic example">
  <button type="button"  class="btn btn-primary" id="all" data-toggle="button">All</button>
  <button type="button"  class="btn btn-secondary" id="routers" data-toggle="button" checked>Routers</button>
  <button type="button"  class="btn btn-secondary" id="switches" data-toggle="button" checked>Switches</button>
 
</div>
</div>
</div>
<div class="col-lg-8">
<!-- displaying equipments-->


      <?php
      $conn = new mysqli('localhost', 'root', '', 'stage01');
      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error); 
      }

     

      // read all row from database table
     
      
      
      $sqlUp = "SELECT * FROM equipments WHERE status ='up'";
      $resultUp = mysqli_query($conn, $sqlUp);
      
      if (!$resultUp) {
        die("Invalid query: " . mysqli_error($conn));
      }
      
      $sqlDown = "SELECT * FROM equipments WHERE status ='down'";
      $resultDown = mysqli_query($conn, $sqlDown);
      
      if (!$resultDown) {
        die("Invalid query: " . mysqli_error($conn));
      }
      ?>
      
      <!-- HTML table to display data -->
      <table class=" table table-status">
        <thead>
          <!-- Table header -->
          <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Model</th>
            <th>IP Address</th>
            <th>Client</th>
            <th>Latest Down Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table rows for "DOWN" status -->
          <?php
          while ($row = mysqli_fetch_assoc($resultDown)) {
            echo '<tr class="table-danger">';
            echo "<td>" . $row["id"] . "</td>
                  <td>" . $row["type"] . "</td>
                  <td>" . $row["brand"] . "</td>
                  <td>" . $row["model"] . "</td>
                  <td>" . $row["IPaddress"] . "</td>
                  <td>" . $row["client"] . "</td>
                  <td>" . $row["latestDownDate"] . "</td>
                  <td>
                    <a class='btn btn-primary btn-sm' href='updateEquip.php?id=" . $row["id"] . "'>Update</a>
                    <a class='btn btn-danger btn-sm' href='deleteEquip.php?id=" . $row["id"] . "'>Delete</a>
                  </td>
                </tr>";
          }
          ?>
      
          <!-- Table rows for "UP" status (hidden by default) -->
          <?php
          while ($row = mysqli_fetch_assoc($resultUp)) {
            echo '<tr class="table-success" style="display: none;">';
            echo "<td>" . $row["id"] . "</td>
                  <td>" . $row["type"] . "</td>
                  <td>" . $row["brand"] . "</td>
                  <td>" . $row["model"] . "</td>
                  <td>" . $row["IPaddress"] . "</td>
                  <td>" . $row["client"] . "</td>
                  <td>" . $row["latestDownDate"] . "</td>
                  <td>
                    <a class='btn btn-primary btn-sm' href='updateEquip.php?id=" . $row["id"] . "'>Update</a>
                    <a class='btn btn-danger btn-sm' href='deleteEquip.php?id=" . $row["id"] . "'>Delete</a>
                  </td>
                </tr>";
          }
          ?>
        </tbody>
      </table>
      
      <!-- JavaScript/jQuery code to handle button clicks -->
      <script>
        $(document).ready(function() {
          // Default: Show data for DOWN status (hide UP status rows)
          $(".table-success").hide();
      
          // Button click handlers
          $("#btnUp").click(function() {
            // Show data for UP status (hide DOWN status rows)
            $(".table-danger").hide();
            $(".table-success").show();
          });
      
          $("#btnDown").click(function() {
            // Show data for DOWN status (hide UP status rows)
            $(".table-success").hide();
            $(".table-danger").show();
          });
        });
      </script>
      




      

    </div>
</section>
</main>
   
    <div class="col-lg-8">
       
  <div id="footer"></div></div>
</body>
</html>