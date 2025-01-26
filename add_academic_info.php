<?php
session_start();
require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $degree = $_POST['degree'];
    $institute = $_POST['institute'];
    $startYear = $_POST['start_year'];
    $endYear = $_POST['end_year'];
    $grade = $_POST['grade'];

    // Validate form data
    if (empty($degree) || empty($institute) || empty($startYear) || empty($endYear) || empty($grade)) {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: edit_profile.php");
        exit();
    }
    $degree = mysqli_real_escape_string($conn, $degree);
    $institute = mysqli_real_escape_string($conn, $institute);
    $startYear = (int)$startYear;
    $endYear = (int)$endYear;
    $grade = mysqli_real_escape_string($conn, $grade);

    // Determine user type and corresponding ID column
    $uid = $_SESSION['uid'];
    $user_type = $_SESSION['user_type'];
    if($user_type === 'student'){
        $id_column = 'sid';
    } 
    if($user_type === 'faculty'){
        $id_column = 'aid';
    }if($user_type === 'alumni'){
        $id_column = 'fid';
    }

    

    // Insert into the database
    $sql = "INSERT INTO academic_background ($id_column, degree, institute, start_year, end_year, grade) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isssis", $uid, $degree, $institute, $startYear, $endYear, $grade);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = "Academic information added successfully.";
        } else {
            $_SESSION['error_message'] = "Error adding academic information. Please try again.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error_message'] = "Database error. Please contact support.";
    }

    mysqli_close($conn);

    // Redirect back to profile
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: dashboard.php");
    exit();
}
?>
