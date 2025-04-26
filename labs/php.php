<?php
// Database connection
$servername = "192.168.0.100";
$username = "chrjymme_dbContacts";
$password = "kZkw8da3VSU9Y2XUJDF9";
$dbname = "chrjymme_dbContacts";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create table
$sql = "CREATE TABLE IF NOT EXISTS tblSMS (
    sms_ID INT AUTO_INCREMENT PRIMARY KEY,
    studno VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    cpno VARCHAR(15) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Add record
if (isset($_POST['add'])) {
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];

    $sql = "INSERT INTO tblSMS (studno, name, cpno) VALUES ('$studno', '$name', '$cpno')";
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully<br>";
    } else {
        echo "Error adding record: " . $conn->error;
    }
}

// Update record
if (isset($_POST['update'])) {
    $sms_ID = $_POST['sms_ID'];
    $studno = $_POST['studno'];
    $name = $_POST['name'];
    $cpno = $_POST['cpno'];

    $sql = "UPDATE tblSMS SET studno='$studno', name='$name', cpno='$cpno' WHERE sms_ID=$sms_ID";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully<br>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete record
if (isset($_POST['delete'])) {
    $sms_ID = $_POST['sms_ID'];

    $sql = "DELETE FROM tblSMS WHERE sms_ID=$sms_ID";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully<br>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch records
$result = $conn->query("SELECT * FROM tblSMS");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage SMS Records</title>
</head>
<body>
    <h1>Manage SMS Records</h1>
    <form method="post">
        <input type="hidden" name="sms_ID" placeholder="SMS ID">
        <input type="text" name="studno" placeholder="Student Number" required>
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="cpno" placeholder="Contact Number" required>
        <button type="submit" name="add">Add</button>
        <button type="submit" name="update">Update</button>
        <button type="submit" name="delete">Delete</button>
    </form>
    <h2>Records</h2>
    <table border="1">
        <tr>
            <th>SMS ID</th>
            <th>Student Number</th>
            <th>Name</th>
            <th>Contact Number</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['sms_ID']; ?></td>
            <td><?php echo $row['studno']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['cpno']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>