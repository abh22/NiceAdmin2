<?php
 $conn = new mysqli('localhost', 'root', '', 'stage01');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


// Retrieve data from the database
$sql = "SELECT e.IPaddress, e.addingDate, h.latestDownDate, h.recoveryDate
        FROM equipments e
        LEFT JOIN historylog h ON e.IPaddress = h.ip";
$result = $conn->query($sql);

// Initialize an array to store equipment-wise MTBF
$mtbf_data = array();

// Calculate MTBF for each equipment
while ($row = $result->fetch_assoc()) {
    $IPaddress = $row['IPaddress'];

    // Parse the JSON data for latestDownDate
    $latest_down_date_json = $row['latestDownDate'];
    $latest_down_date_data = json_decode($latest_down_date_json, true);

    // Parse the JSON data for recoveryDate
    $recovery_date_json = $row['recoveryDate'];
    $recovery_date_data = json_decode($recovery_date_json, true);

    // Initialize variables to store MTBF calculation
    $total_uptime_seconds = 0;
    $num_failures = 0;

    // Loop through the latestDownDate keys and extract the date portion (YYYY-MM-DD)
    if (is_array($latest_down_date_data)  ) {
    foreach ($latest_down_date_data as $key => $value) {
        
        if (isset($recovery_date_data[$key])) {
            $latest_down_date = strtotime($value);
          
            $recovery_date = strtotime($recovery_date_data[$key]);
           
            
             // Calculate the uptime (time between latest failure and recovery) in seconds
             $uptime_seconds = $recovery_date - $latest_down_date;
             $total_uptime_seconds += $uptime_seconds;
             $num_failures++;
    
           
        }
        else{
            $latest_down_date = strtotime($value);
          
            $recovery_date = strtotime("0000-00-00 00:00:00");
           
            
             // Calculate the uptime (time between latest failure and recovery) in seconds
         $uptime_seconds =  $latest_down_date - strtotime($row["addingDate"]) ;
         $total_uptime_seconds += $uptime_seconds;
         $num_failures++;
        }
        
        
    }

    // Calculate the MTBF for this equipment in days plus hours
    if ($num_failures > 0) {
        $mtbf_seconds = $total_uptime_seconds / $num_failures;
        $mtbf_days = floor($mtbf_seconds / 86400); // 86400 seconds in a day
        $remaining_seconds = $mtbf_seconds % 86400; // Remaining seconds after days
        $mtbf_hours = floor($remaining_seconds / 3600); // 3600 seconds in an hour

        // Build the MTBF result string
        $mtbf = $mtbf_days . " days";
        if ($mtbf_hours > 0) {
            $mtbf .= " and " . $mtbf_hours . " hours";
        }

        // Store the MTBF in the array with IPaddress as the key
        $mtbf_data[$IPaddress] = $mtbf;
    }
    
}}

// Display MTBF data
foreach ($mtbf_data as $IPaddress => $mtbf) {
    $mtbfstr=(string)$mtbf;
  $sql = "UPDATE  historylog  SET mbtf ='$mtbfstr' WHERE ip='$IPaddress'";
  $result = $conn->query($sql);
}

$conn->close();
?>
