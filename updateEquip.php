<?php
 $conn = new mysqli('localhost', 'root', '', 'stage01');
 if ($conn->connect_error) {
     die('Connection failed: ' . $conn->connect_error); // Added die() to terminate the script
 }
if($_SERVER['REQUEST_METHOD']== 'GET'){
    if(!isset($_GET["id"])){
        header("Location: equipments.php");
        exit;
    }
    $id=$_GET["id"];
    $sql = "SELECT * FROM equipments WHERE id= '$id'";
    $result = mysqli_query($conn,$sql);
    $row=$result->fetch_assoc();
if(!$row){
    header("Location: equipments.php");
    exit;
}
$type=$row["type"];
$brand=$row["brand"];
$model=$row["model"];
$ipAddress=$row["IPaddress"];
$client=$row["client"];
echo "1";
} else {
$id=$_GET["id"];
$type=$_POST["type"];
$brand=$_POST["brand"];
$model=$_POST["model"];
$ipAddress=$_POST["ip"];
$client=$_POST["client"];
echo "2";
do{
    if(empty($id) || empty($type) || empty($brand) || empty($model) || empty($ipAddress) || empty($client)){
        echo "Missing required field";
        break;
    }
    echo "$id $type $brand $model";
    $sql="UPDATE equipments 
    SET type= '$type', brand='$brand', model='$model', IPaddress='$ipAddress', client='$client' 
    WHERE id=$id ";
    
    $result = mysqli_query($conn,$sql);
    if(!$result){
        echo "invalid query" . $conn->error_get_last;
        break;
    }
    echo "successful edit";
    header("Location: equipments.php");
    exit();
 }while(false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script
      src="https://code.jquery.com/jquery-3.7.0.min.js"
      integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
      crossorigin="anonymous"
    ></script>
    <script>
      $(function () {
        $("#header").load("header.html");});
        </script>
</head>
<body>
<div id="header"></div>
<!-- adding equipment form-->
<form
class="main"

  id="addequip"
  style="padding: 100px"
  
  method="post"
  class="row g-3 needs-validation"
  novalidate
>
<input type="hidden" name="id" value="<?php echo $id;?>">
  <h3 style="color: blue">Edit Equipment info:</h3>
  <div class="col-8">
    <label for="Equipment type" class="form-label"
      >Equipment type</label
    >
    <input
      type="text"
      value="<?php echo $type;?>"
      readonly
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
      value="<?php echo $brand;?>"
      readonly
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
        value="<?php echo $model;?>"
        readonly
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
      value="<?php echo $ipAddress;?>"
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
    
    <div class="invalid-feedback">
      Please confirm your client!
    </div>
  </div>
  <div class="col-8">
    <label for="yourPassword" class="form-label"
      ><select class="form-select form-select-sm" aria-label=".form-select-sm example" name="client" id="name">
                      <option selected><?php echo $client;?></option>
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
    </select>Password</label
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
    <button class="btn btn-primary w-40" name="update" type="submit">
      Update
    </button>
  </div>
</form>
</body>
</html>
