<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "PHP is working!<br>";

$conn = mysqli_connect("localhost", "root", "", "hostel_management");

if (!$conn) {
    die("❌ Connection failed: " . mysqli_connect_error());
} else {
    echo "✅ Connected to MySQL successfully!";
}
?>