<?php
// Start the session to check if the user is logged in
session_start();

// Check if the session is set
if (!isset($_SESSION['user_logged_in'])) {
    // If session is not set, redirect to the blog page
    header("Location: blogs.php"); // Replace 'blogs.php' with the actual blog page URL
    exit();
}

require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php"; // Replace with your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $blogTitle = mysqli_real_escape_string($conn, $_POST['blog_title']);
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    $blogContent = mysqli_real_escape_string($conn, $_POST['blog_content']);
    $authorname = $_SESSION['username'];

    // Insert data into the blog table
    $query = "INSERT INTO blog (blog_title, tag,  blog_content , author) 
              VALUES ('$blogTitle', '$tags', '$blogContent' , '$authorname')";

    if (mysqli_query($conn, $query)) {
        echo "Blog posted successfully!";
        header("Location: blogs.php");
        exit();

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        header("Location: blogs.php");
        exit();

    }
}
?>
