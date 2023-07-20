<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding customer</title>
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
<!-- adding customer form-->
<div class="col-lg-8">
<form id="addcust" style="padding: 50px;" action="addcust.php" method="post" class="row g-3 needs-validation" novalidate>
                    <h3 style="color: blue;">Add customer</h3>
                    <div class="col-8" >
                      <label for="customer type" class="form-label">Customer type</label>
                      <div style="display:flex;">
                      <div class="form-check" >
  <input class="form-check-input" type="checkbox" name=type[] value="" id="flexCheckDefault">
  <label  class="form-check-label" for="flexCheckDefault">
   Association
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" name=type[] value="" id="flexCheckChecked" >
  <label  class="form-check-label" for="flexCheckChecked">
   Individual
  </label>
</div></div>
                      <div class="invalid-feedback">Please, enter the customer type!</div>
                    </div>

                    <div class="col-8">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" name="name" placeholder="Example: ATB" class="form-control" id="name" required>
                      
                    </div>

                    <div class="col-8">
                      <label for="Email" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        
                        <input type="email" name="email" class="form-control" id="ref" required>
                        <div class="invalid-feedback">Please insert an email.</div>
                      </div>
                    </div>
                    <div class="col-4">
                        <label for="yourPassword" class="form-label">Contact number</label>
                        <input type="tel" name="tel" class="form-control" id="tel" required>
                        <div class="invalid-feedback">Please confirm the contact number</div>
                      </div>
                      <div class="col-8">
                      <label for="address" class="form-label">Address</label>
                      <input type="text" name="address" class="form-control" id="address" required>
                      <div class="invalid-feedback">Please enter an address </div>
                    </div>
                    <div class="col-8">
                      <label for="yourPassword" class="form-label">Your Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-40" name="add" type="submit">Add customer</button>
                      </div>
    </form>
    </div>
    </main>
    <div class="col-lg-8">       
                      <div id="footer"></div></div>
                      </body>
</html>