<?php
$servername = "panel.freehosting.com"; 
$username = "chrjymme_dbContacts";
$password = "kZkw8da3VSU9Y2XUJDF9";
$dbname = "chrjymme_dbContacts";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
