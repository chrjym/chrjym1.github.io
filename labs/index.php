<?php
include 'db.php'; 

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

        if ($stmt->execute()) {
            echo "Record added successfully!<br>";
        } else {
            echo "Error adding record: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    if (isset($_POST['update'])) {
        $sms_ID = $_POST['sms_ID'];
        $studno = $_POST['studno'];
        $name = $_POST['name'];
        $cpno = $_POST['cpno'];

        if (!empty($sms_ID)) {
            $stmt = $conn->prepare("UPDATE tblSMS SET studno=?, name=?, cpno=? WHERE sms_ID=?");
            $stmt->bind_param("sssi", $studno, $name, $cpno, $sms_ID);

            if ($stmt->execute()) {
                echo "Record updated successfully!<br>";
            } else {
                echo "Error updating record: " . $stmt->error . "<br>";
            }
            $stmt->close();
        } else {
            echo "Error: SMS ID is required for update.<br>";
        }
    }

    if (isset($_POST['delete'])) {
        $sms_ID = $_POST['sms_ID'];

        if (!empty($sms_ID)) {
            $stmt = $conn->prepare("DELETE FROM tblSMS WHERE sms_ID=?");
            $stmt->bind_param("i", $sms_ID);

            if ($stmt->execute()) {
                echo "Record deleted successfully!<br>";
            } else {
                echo "Error deleting record: " . $stmt->error . "<br>";
            }
            $stmt->close();
        } else {
            echo "Error: SMS ID is required for deletion.<br>";
        }
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
        <input type="hidden" name="sms_ID" id="sms_ID">
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
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['sms_ID']; ?></td>
            <td><?= $row['studno']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['cpno']; ?></td>
            <td>
                <button onclick="populateForm(<?= $row['sms_ID']; ?>, '<?= $row['studno']; ?>', '<?= $row['name']; ?>', '<?= $row['cpno']; ?>')">Edit</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <script>
        function populateForm(id, studno, name, cpno) {
            document.getElementById('sms_ID').value = id;
            document.querySelector('input[name="studno"]').value = studno;
            document.querySelector('input[name="name"]').value = name;
            document.querySelector('input[name="cpno"]').value = cpno;
        }
    </script>

</body>
</html>

<?php $conn->close(); ?>
