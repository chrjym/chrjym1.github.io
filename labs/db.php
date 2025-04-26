<?php
// Database connection
$servername = "195.201.179.8"; // Check FreeHosting for correct DB host
$username = "chrjymme_dbContacts";
$password = "kZkw8da3VSU9Y2XUJDF9";
$dbname = "chrjymme_dbContacts";

// Create connection with database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
