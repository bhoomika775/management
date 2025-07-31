<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Welcome Admin</h1>
    <p>Logged in as: <?php echo $_SESSION['admin_email']; ?></p>

    <ul>
        <li><a href="manage.php">Manage Bookings</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>