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
                    <th>LatestDownDate</th>
                    <th>LatestDownDate Ms</th>
                    <th>Recovery Date</th>
                    <th>Up Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function timeDiff($milliseconds)
                {
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
                  return "$seconds second" . ($seconds > 1 ? 's' : '') . " ago";
    
    
                }
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
                    $latestDownDate = json_decode($row["latestDownDate"], true);
                    $recoveryDate = json_decode($row["recoveryDate"],true);
                    $currentTime = time() * 1000;
                    if ( !is_array($recoveryDate)){
                     $recoveryDate = [];
                    }
                    // if ( !is_array($latestDownDate)){
                    //   $latestDownDate = [];
                    // }

                    
                    
                    if (is_array($latestDownDate)  ) {
                        foreach ($latestDownDate as $key => $value) {
                          if (isset($recoveryDate[$key])) {
                            echo "<tr>
                                    <td>" . $row["ip"] . "</td>
                                    <td>" . $value . "</td>
                                    <td> " ; echo is_null($value) ? "null" : timeDiff($currentTime - (int)(strtotime($value) * 1000)); echo "
                                      </td>
                        
                        
                        
                                 <td> " . $recoveryDate[$key] . "</td>             
                                        
                                        <td>" . $row["mbtf"] . "</td>
                                    </tr>";
                                    
                            }else{
                              echo "<tr>
                                    <td>" . $row["ip"] . "</td>
                                    <td>" . $value. "</td>
                                    <td> " ; echo is_null($value) ? "null" : timeDiff($currentTime - (int)(strtotime($value) * 1000)); echo "
                                      </td>
                        
                        
                        
                                 <td>   --  </td>             
                                        
                                        <td>" . $row["mbtf"] . "</td>
                                    </tr>";
                            }
                          }
                          }
                    
                    else {
                    // header("Location: equipStatus.php");
                    echo $id;
                    exit;
                }}

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
