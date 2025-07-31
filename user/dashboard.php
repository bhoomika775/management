<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>

    <p><a href="booking.php">Book a Room</a></p>
    <p><a href="logout.php" style="color:red;">Logout</a></p>
</body>
</html>