<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit();
}

include("../includes/db.php");

// Fetch bookings from the database
$query = "SELECT bookings.id, users.name, users.email, bookings.room_no, bookings.date, bookings.status 
          FROM bookings 
          JOIN users ON bookings.user_id = users.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Manage Bookings</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Room No</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['room_no']); ?></td>
            <td><?php echo htmlspecialchars($row['date']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>