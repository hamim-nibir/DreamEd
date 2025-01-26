<?php
session_start();
require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: login.php");
    exit();
}

// Get user data from the session
$uid = $_SESSION['uid'];
$user_type = $_SESSION['user_type'];

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch current data
    $sql = "SELECT * FROM $user_type WHERE uid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $currentData = mysqli_fetch_assoc($result);

    if (!$currentData) {
        echo "Error fetching user data.";
        exit();
    }

    // Sanitize and retrieve form inputs, fallback to current values if empty
    $first_name = !empty(trim($_POST['first_name'])) ? htmlspecialchars(trim($_POST['first_name'])) : $currentData['first_name'];
    $last_name = !empty(trim($_POST['last_name'])) ? htmlspecialchars(trim($_POST['last_name'])) : $currentData['last_name'];
    $contact_no = !empty(trim($_POST['contact_no'])) ? htmlspecialchars(trim($_POST['contact_no'])) : $currentData['contact_no'];
    $email = !empty(trim($_POST['email'])) ? htmlspecialchars(trim($_POST['email'])) : $currentData['email'];

    // Additional fields for faculty
    if ($user_type === 'faculty') {
        $current_institute = !empty(trim($_POST['current_institute'])) ? htmlspecialchars(trim($_POST['current_institute'])) : $currentData['current_institute'];
        $designation = !empty(trim($_POST['designation'])) ? htmlspecialchars(trim($_POST['designation'])) : $currentData['designation'];
        $research_interest = !empty(trim($_POST['research_interest'])) ? htmlspecialchars(trim($_POST['research_interest'])) : $currentData['research_interest'];
    }

    // Update the user's information in the database
    if ($user_type === 'student') {
        $dob = !empty(trim($_POST['dob'])) ? htmlspecialchars(trim($_POST['dob'])) : $currentData['dob'];
        $blood_group = !empty(trim($_POST['blood_group'])) ? htmlspecialchars(trim($_POST['blood_group'])) : $currentData['blood_grp'];

        $sql = "UPDATE $user_type 
                SET first_name = ?, last_name = ?, contact_no = ?, dob = ?, blood_grp = ?, email = ? 
                WHERE uid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $first_name, $last_name, $contact_no, $dob, $blood_group, $email, $uid);
    } elseif ($user_type === 'faculty') {
        $sql = "UPDATE $user_type 
                SET first_name = ?, last_name = ?, contact_no = ?, email = ?, current_institute = ?, designation = ?, research_interest = ? 
                WHERE uid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $first_name, $last_name, $contact_no, $email, $current_institute, $designation, $research_interest, $uid);
    }

    // Execute the update query
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Profile updated successfully.');</script>";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

mysqli_close($conn);
?>
