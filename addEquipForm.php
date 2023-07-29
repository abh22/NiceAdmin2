<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <!-- adding equipment form-->
        <div class="col-lg-8">
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
                      <label for="name" class="form-label">Equipment type</label>
                      <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="type" id="name">
                      <option value="Router">Router</option>
                      <option value="Switc">Switch</option>
    </select>
    </div>
    <div class="col-8">
                      <label for="name" class="form-label">Brand</label>
                      <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="brand" id="name">
                      
                      
                <?php
      $conn = new mysqli('localhost', 'root', '', 'stage01');
      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error); 
      }

     

      // read all row from database table
$sql = "SELECT DISTINCT brand FROM equipments";
$result = mysqli_query($conn,$sql);
$sql1 = "SELECT DISTINCT model FROM equipments";
$result1 = mysqli_query($conn,$sql1);

      if (!$result) {
  die("Invalid query: " . $connection->error);
}

      // read data of each row
while($row = $result->fetch_assoc()) {
  echo "<option value='" . $row["brand"] . "'>" . $row["brand"] . "</option>";
}
  echo "</select>";
  echo '<div class="col-8">';
 echo '<label for="name" class="form-label">Model</label>';
 echo ' <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="model" id="model">';
 while($row1 = $result1->fetch_assoc()) {
  echo "<option value='" . $row1["model"] . "'>" . $row1["model"] . "</option>";}
  echo '</select>';
    


        $conn->close();
        ?>
                



              
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
                    >Associated client</label>
                  
                      <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="client" id="name">
                      <option selected>--</option>
                      <?php
      $conn = new mysqli('localhost', 'root', '', 'stage01');
      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error); 
      }

     

      // read all row from database table
$sql = "SELECT * FROM customers";
$result = mysqli_query($conn,$sql);

      if (!$result) {
  die("Invalid query: " . $connection->error);
}

      // read data of each row
while($row = $result->fetch_assoc()) {
  echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
}
        $conn->close();
        ?>
    </select>
                    </div>
                <div class="col-8">
                      <label for="yourPassword" class="form-label">Login</label>
                      <input type="text" name="login" class="form-control" id="log" required>
                      <div class="invalid-feedback">Please enter your login </div>
                    </div>
                    <div class="col-8">
                      <label for="yourPassword" class="form-label"> Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter password </div>
                    </div>
                <div class="col-12">
                  <button class="btn btn-primary w-40" name="add" type="submit">
                    Add Equipment
                  </button>
                </div>
              </form>
    </div>
    </main>
    <div class="col-lg-8">
    <div id="footer"></div></div>
</body>
</html>