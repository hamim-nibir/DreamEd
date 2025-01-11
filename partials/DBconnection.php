<?php
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "dreamed";
    $dbPort = 3312; // Specify the port

    // Include the port in the connection
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName, $dbPort);

    if (!$conn) {
        die("Something went wrong: " . mysqli_connect_error());
    }

?>
