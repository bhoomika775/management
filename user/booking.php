<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['email'])) {
    die("❌ User not logged in.");
}

// Get user_id from DB based on session email (only if not already stored in session)
if (!isset($_SESSION['user_id'])) {
    $email = $_SESSION['email'];
    $userQuery = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $userQuery->bind_param("s", $email);
    $userQuery->execute();
    $result = $userQuery->get_result();
    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $userQuery->close();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_no = trim($_POST['room_no']);
    $user_id = $_SESSION['user_id'];
    $date = date("Y-m-d");
    $status = "Booked";

    if (!empty($room_no)) {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_no, date, status) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            die("❌ Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("isss", $user_id, $room_no, $date, $status);

        if ($stmt->execute()) {
            $message = "✅ Room booked successfully!";
        } else {
            $message = "❌ Execute failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "❌ Room number is required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book a Room</title>
</head>
<body>
    <h2>Book a Room</h2>

    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <form method="POST">
        <label for="room_no">Room Number:</label>
        <input type="text" name="room_no" required><br><br>
        <button type="submit">Book Now</button>
    </form>

    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>