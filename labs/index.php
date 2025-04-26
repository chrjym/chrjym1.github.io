<?php
include 'db.php'; // Securely include database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $studno = $_POST['studno'];
        $name = $_POST['name'];
        $cpno = $_POST['cpno'];

        $stmt = $conn->prepare("INSERT INTO tblSMS (studno, name, cpno) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $studno, $name, $cpno);
        $stmt->execute();
        $stmt->close();
        echo "Record added successfully!<br>";
    }

    if (isset($_POST['update'])) {
        $sms_ID = $_POST['sms_ID'];
        $studno = $_POST['studno'];
        $name = $_POST['name'];
        $cpno = $_POST['cpno'];

        $stmt = $conn->prepare("UPDATE tblSMS SET studno=?, name=?, cpno=? WHERE sms_ID=?");
        $stmt->bind_param("sssi", $studno, $name, $cpno, $sms_ID);
        $stmt->execute();
        $stmt->close();
        echo "Record updated successfully!<br>";
    }

    if (isset($_POST['delete'])) {
        $sms_ID = $_POST['sms_ID'];

        $stmt = $conn->prepare("DELETE FROM tblSMS WHERE sms_ID=?");
        $stmt->bind_param("i", $sms_ID);
        $stmt->execute();
        $stmt->close();
        echo "Record deleted successfully!<br>";
    }
}

// Fetch records
$result = $conn->query("SELECT * FROM tblSMS");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage SMS Records</title>
</head>
<body>
    <h1>Manage SMS Records</h1>
    
    <form action="index.php" method="post">
        <input type="hidden" name="sms_ID">
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
            <td><?= $row['sms_ID']; ?></td>
            <td><?= $row['studno']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['cpno']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
