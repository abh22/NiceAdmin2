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
      <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
              <!-- Equipments Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card equipments-card">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"
                      ><i class="bi bi-three-dots"></i
                    ></a>
                    <ul
                      class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"
                    >
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>

                             
  
  <li><a  class="dropdown-item" href="#">Type</a></li>
     
      
   
  


                    
                      <li><a  class="dropdown-item" href="#">Client</a></li>
                      <li><a style="color: rgb(191, 4, 4);" class="dropdown-item" href="#">Status Down</a></li>
                    </ul>
                  </div>
                  <a href="./equipments.php" target="_blank">
                    <div class="card-body">
                      <h5 class="card-title">
                        Equips <span>| All</span>
                      </h5>

                      <div class="d-flex align-items-center">
                        <div
                          class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                        >
                          <i class="bi bi-router"></i>
                        </div>
                        <div class="ps-3">
                          <h6>#</h6>
                          <span class="text-success small pt-1 fw-bold"
                            >Total</span
                          >
                          <span class="text-muted small pt-2 ps-1"
                            >1200</span
                          >
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <!-- End Equipments Card -->
            
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
              <!-- adding equipment form-->
              <form
                id="addequip"
                style="padding: 50px"
                action="addequip.php"
                method="post"
                class="row g-3 needs-validation"
                novalidate
              >
                <h3 style="color: blue">Add equipment</h3>
                <div class="col-8">
                  <label for="Equipment type" class="form-label"
                    >Equipment type</label
                  >
                  <input
                    type="text"
                    name="type"
                    placeholder="Router,Switcher.."
                    class="form-control"
                    id="equiptype"
                    required
                  />
                  <div class="invalid-feedback">
                    Please, enter the equipment type!
                  </div>
                </div>

                <div class="col-8">
                  <label for="Brand" class="form-label">Brand</label>
                  <input
                    type="text"
                    name="brand"
                    placeholder="Example: Cisco"
                    class="form-control"
                    id="yourEmail"
                    required
                  />
                </div>

                <div class="col-8">
                  <label for="Model" class="form-label">Model</label>
                  <div class="input-group has-validation">
                    <input
                      type="text"
                      name="model"
                      class="form-control"
                      id="ref"
                      required
                    />
                    <div class="invalid-feedback">Please insert a Model.</div>
                  </div>
                </div>
                <div class="col-8">
                  <label for="ip" class="form-label"
                    >IP address</label
                  >
                  <input
                    type="text"
                    name="ip"
                    class="form-control"
                    id="ip"
                    required
                  />
                  <div class="invalid-feedback">Please enter IP</div>
                </div>
                <div class="col-8">
                  <label for="client" class="form-label"
                    >Associated client</label
                  >
                  <input
                    type="text"
                    name="client"
                    class="form-control"
                    id="client"
                    required
                  />
                  <div class="invalid-feedback">
                    Please confirm your client!
                  </div>
                </div>
                <div class="col-8">
                  <label for="yourPassword" class="form-label"
                    >Password</label
                  >
                  <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="yourPassword"
                    required
                  />
                  <div class="invalid-feedback">Please enter  password</div>
                </div>
                <div class="col-8">
                  <button class="btn btn-primary w-40" name="add" type="submit">
                    Add Equipment
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-4">
            <div
              style="
                font-size: 25px;
                padding: 30px;
                font-family: 'Lucida Sans', 'Lucida Sans Regular',
                  'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana,
                  sans-serif;
              "
            >
              <a href="#addequip">
                <i class="bi bi-plus-square-fill"></i>
                Add Equipment
              </a>
            </div>
            <div id="rightside"></div>
          </div>
        </div>
      </section>
    </main>
    <div id="footer"></div>
  </body>
</html>
