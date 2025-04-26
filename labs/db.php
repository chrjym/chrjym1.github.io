<?php
$servername = "panel.freehosting.com"; 
$username = "chrjymme_dbContacts";
$password = "Blackpinklalisam@1";
$dbname = "chrjymme_dbContacts";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
