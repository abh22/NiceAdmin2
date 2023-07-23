
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - TT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.css">
  
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
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
   
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            

            <!-- Equipments Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card equipments-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
                
                <div class="card-body">
                  <h5 class="card-title">Equipments <span>| Total</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-router"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                       $conn = new mysqli('localhost', 'root', '', 'stage01');
                       if ($conn->connect_error) {
                           die('Connection failed: ' . $conn->connect_error); // Added die() to terminate the script
                       }
                       $select = "SELECT * FROM equipments";
                        $result = mysqli_query($conn, $select);
                        $data=mysqli_num_rows($result);
                        echo $data;
                      ?></h6>
                      <span class="text-success small pt-1 fw-bold"><?php $select = "SELECT * FROM equipments WHERE status='up'";
                        $resultUP = mysqli_query($conn, $select);
                        $dataUP=mysqli_num_rows($resultUP);
                        echo number_format($dataUP/$data *100, 1);
                        "#%" ?></span> <span class="text-muted small pt-2 ps-1">% connected</span>

                    </div>
                  </div>
                </div>
              
              </div>
            </div><!-- End Equipments Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
                <!-- <a  href="./customers.php"  > -->
                <div class="card-body">
                  <h5 class="card-title">Customers <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                      <?php 
                       $conn = new mysqli('localhost', 'root', '', 'stage01');
                       if ($conn->connect_error) {
                           die('Connection failed: ' . $conn->connect_error); // Added die() to terminate the script
                       }
                       $select = "SELECT * FROM customers";
                        $result = mysqli_query($conn, $select);
                        $data=mysqli_num_rows($result);
                        echo $data;
                      ?></h6>
                      </h6>
                      <span class="text-danger small pt-1 fw-bold">#%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>
                <!-- </a> -->
                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <!-- <div id="reportsChart"></div> -->

                 
                  <div id="reportsChart"></div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      <?php
      $conn = new mysqli('localhost', 'root', '', 'stage01');
      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error);
      }

      //count customers
      $sqlCustCountsByMonth = "
      SELECT
      month,
      cust_count AS count_in_month,
      SUM(cust_count) OVER (ORDER BY month) AS cumulative_count
    FROM
      (
        SELECT
          DATE_FORMAT(subscriptionDate, '%Y-%m') AS month,
          COUNT(*) AS cust_count
        FROM
          customers
        GROUP BY
          DATE_FORMAT(subscriptionDate, '%Y-%m')
      ) t1
    ORDER BY
      month
    ";


    $resultCustCountsByMonth = mysqli_query($conn, $sqlCustCountsByMonth);

    if (!$resultCustCountsByMonth) {
      die("Invalid query: " . $conn->error);
    }

    $custCountsByMonth = array();
    
    while ($rowCustCount = mysqli_fetch_assoc($resultCustCountsByMonth)) {
      $month = $rowCustCount['month'];
      $custCount = $rowCustCount['cumulative_count'];
      $custCountsByMonth[$month] = $custCount;
    }
    

      
      // count equipments

      $sqlEquipCountsByMonth = "
        SELECT
          DATE_FORMAT(addingDate, '%Y-%m') AS month,
          COUNT(*) AS equip_count
        FROM
          equipments
        GROUP BY
          DATE_FORMAT(addingDate, '%Y-%m')
        ORDER BY
          DATE_FORMAT(addingDate, '%Y-%m')
      ";

      $resultEquipCountsByMonth = mysqli_query($conn, $sqlEquipCountsByMonth);

      if (!$resultEquipCountsByMonth) {
        die("Invalid query: " . $conn->error);
      }

      $equipCountsByMonth = array();
      
      while ($rowEquipCount = mysqli_fetch_assoc($resultEquipCountsByMonth)) {
        $month = $rowEquipCount['month'];
        $equipCount = $rowEquipCount['equip_count'];
        $equipCountsByMonth[$month] = $equipCount;
      }
      
// $sqlUpEquipCountsByMonth="
// SELECT
// DATE_FORMAT(latestDownDate, '%Y-%m') AS month,
// COUNT(*) AS up_equip_count Where status='up'
// FROM
// equipments
// GROUP BY
// DATE_FORMAT(latestDownDate, '%Y-%m')
// ORDER BY
// DATE_FORMAT(latestDownDate, '%Y-%m')
// ";
// $resultUpEquipCountsByMonth=mysqli_query($conn,$sqlUpEquipCountsByMonth);
// if (!$resultUpEquipCountsByMonth) {
//   die("Invalid query: " . $conn->error);
// }

// $upEquipCountsByMonth = array();

// while ($rowUpEquipCount = mysqli_fetch_assoc($resultUpEquipCountsByMonth)) {
//   $month = $rowUpEquipCount['month'];
//   $upEquipCount = $rowEquipCount['up_equip_count'];
//   $upEquipCountsByMonth[$month] = $equipCount;
// }

      // $sqlUpequip = "SELECT count(*) AS Upequip_count FROM equipments WHERE status='up'";
      // $resultUpequip = mysqli_query($conn, $sqlUpequip);

      // if (!$resultUpequip) {
      //   die("Invalid query: " . $conn->error);
      // }

      // $rowcust = mysqli_fetch_assoc($resultcust);
      // $rowUpequip = mysqli_fetch_assoc($resultUpequip);
      ?>

      // Convert the PHP associative array to JavaScript object
      const equipCountsByMonth = <?php echo json_encode($equipCountsByMonth); ?>;
      const custCountsByMonth = <?php echo json_encode($custCountsByMonth); ?>;
      

      // Extract the month names and equipment counts from the JavaScript object
      const monthNames = Object.keys(equipCountsByMonth);
      const equipCounts = Object.values(equipCountsByMonth);
      const custCounts = Object.values(custCountsByMonth);
     

      // JavaScript code to render the chart
      new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{
          name: 'Equipments',
          data: equipCounts,
        }, {
          name: 'Customers',
          data: custCounts,
        }],
        chart: {
          height: 350,
          type: 'area',
          toolbar: {
            show: false
          },
        },
        xaxis: {
          type: 'category',
          categories: monthNames,
        },
        tooltip: {
          x: {
            format: 'yyyy-MM',
          },
        }
      }).render();
    });
  </script>






<!-- End Line Chart -->

</div>

</div>
</div><!-- End Reports -->


           </div>
        </div><!-- End Left side columns -->

        <div class="col-lg-4">
          <div id="rightside"></div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <div class="col-lg-8">
       
  <div id="footer"></div></div>

</body>

</html>