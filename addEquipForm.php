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
    </main>
    <div class="col-lg-8">
    <div id="footer"></div></div>
</body>
</html>