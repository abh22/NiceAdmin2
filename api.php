<?php
// Database connection setup (replace with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'stage01');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error); 
    }

// Set the appropriate headers for JSON response
header("Content-Type: application/json");

// API endpoint to retrieve data from the database (you can customize this query as per your database structure)
$sql = "SELECT * FROM equipments WHERE status='down'";
$result = $conn->query($sql);

if (!$result) {
  die("Invalid query: " . $conn->error);
}

// Fetch data from the database and store in an array
$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

// Close the database connection
$conn->close();

// Convert the data to JSON format and echo the response
echo json_encode($data);
?>
