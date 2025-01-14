<?php
session_start();
require_once "partials/DBconnection.php"; // Include your DB connection

if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];
$user_type = $_SESSION['user_type'];
$sql = "SELECT * FROM $user_type WHERE uid = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Error fetching user data.";
    exit();
}
?>
<h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
