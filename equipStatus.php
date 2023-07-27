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
  <div class="pagetitle">
      
      <h1>Dashboard</h1>
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Equipments status</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
  <section class="section dashboard">
  
  <!-- <div class="btn-group-filter">
 
  <div class="col-lg-4">
   
<div  class="btn-group" role="group" aria-label="Basic example">
  <button type="button"  class="btn btn-primary" id="btnUp" data-toggle="button">UP</button>
  <button type="button"  class="btn btn-secondary" id="btnDown" data-toggle="button" checked>DOWN</button>
 
</div> -->
<!-- <div  class="btn-group" role="group" aria-label="Basic example">
  <button type="button"  class="btn btn-primary" id="all" data-toggle="button">All</button>
  <button type="button"  class="btn btn-secondary" id="routers" data-toggle="button" checked>Routers</button>
  <button type="button"  class="btn btn-secondary" id="switches" data-toggle="button" checked>Switches</button>
 
</div> -->
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
     
      
      
      $sql = "SELECT * FROM equipments ORDER BY status";
      $result = mysqli_query($conn, $sql);
      
      if (!$result) {
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
      
          <!-- Table rows  -->
          <?php
          function timeDiff($milliseconds) {
            // Convert milliseconds to seconds
            $seconds = $milliseconds / 1000;
        
            // Calculate the components
            $days = floor($seconds / (60 * 60 * 24));
            $seconds %= (60 * 60 * 24);
            $hours = floor($seconds / (60 * 60));
            $seconds %= (60 * 60);
            $minutes = floor($seconds / 60);
            $seconds %= 60;
        
            // Build the result string
           
            if ($days > 0) {
                return "$days day" . ($days > 1 ? 's' : '') . ' ago ';
            }
            
            if ($hours > 0) {
               return "$hours hour" . ($hours > 1 ? 's' : '') . ' ago';
            }
            if ($minutes > 0) {
               return "$minutes minute" . ($minutes > 1 ? 's' : '') . ' ago ';
            }
            return "$seconds second" . ($seconds > 1 ? 's' : '' ) . " ago";
        
            
        }
        
          while ($row = mysqli_fetch_assoc($result)) {
            if($row["status"]=='down')
            {echo '<tr class="table-danger">';}
            else{echo '<tr class="table-success">';}

            $currentTime= time()*1000;
            echo "<td>" . $row["id"] . "</td>
                  <td>" . $row["type"] . "</td>
                  <td>" . $row["brand"] . "</td>
                  <td>" . $row["model"] . "</td>
                  <td>" . $row["IPaddress"] . "</td>
                  <td>" . $row["client"] . "</td>
                  <td>" . timeDiff($currentTime-$row["latestDownDateMs"]). "</td>
                
                  <td>
                    <a class='btn btn-primary btn-sm' href='updateEquip.php?id=" . $row["id"] . "'>History</a>
                    
                  </td>
                </tr>";
               


          }
          ?>
      
      
          
          
        </tbody>
      </table>
      
     
      
      




      

    </div>
</section>
</main>
   
    <div class="col-lg-8">
       
  <div id="footer"></div></div>
</body>
</html>