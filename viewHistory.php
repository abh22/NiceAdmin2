<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
      $(function () {
        $("#header").load("header.html");
        $("#side").load("sidebar.html");
      });
    </script>
</head>
<body>
    <div id="header"></div>
    <div id="side"></div>
    <main id="main" class="main">
        <!-- displaying equipment data -->
        <table class="table">
            <thead>
                <tr>
                    <th>Ip</th>
                    <th>Latest Down Date</th>
                    <th>Recovery Date</th>
                    <th>Up Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'stage01');
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

                // Read the row from the database table
                $id = $_GET["id"];
               
               
                $sql = "SELECT IPaddress FROM equipments WHERE id= '$id'";
                $result = mysqli_query($conn, $sql);
                if (!$result || mysqli_num_rows($result) === 0) {
                    die("Invalid query: " . mysqli_error($conn));
                }
                $row = mysqli_fetch_assoc($result);
                $ip = $row["IPaddress"];

                $sqlLog = "SELECT * FROM historylog WHERE ip= '$ip'";
                $resultLog = mysqli_query($conn, $sqlLog);
                if (!$resultLog) {
                    die("Invalid query: " . mysqli_error($conn));
                  }

                if ($resultLog->num_rows > 0) {
                    $row = $resultLog->fetch_assoc();
                    echo "<tr>
                            <td>" . $row["ip"] . "</td>
                            <td>" . $row["latestDownDate"] . "</td>
                            <td>" . $row["recoveryDate"] . "</td>
                            <td>" . $row["upTime"] . "</td>
                          </tr>";
                } else {
                    header("Location: equipStatus.php");
                    exit;
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <div class="col-lg-8">
        <div id="footer"></div>
    </div>
</body>
</html>
