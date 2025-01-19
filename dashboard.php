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
} else {
    $fullName = $user['first_name'] . " " . $user['last_name'];
    $email = $user['email'];
    $contactNumber = $user['contact_no'];
    $dob = $user['dob'];
    // $address = $user['present_address'];
    // $profilePicture = $user['profile_picture'] ? $user['profile_picture'] : 'default-profile.png';
    $bloodGroup = $user['blood_grp'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">DreamEd</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="universities.php">Universities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Scholarships</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="preparations.php">Preparations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blogs</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right-side icons -->
            <ul class="nav-right">
                <!-- Search Icon -->
                <li><a href="#"><i class="fas fa-search"></i></a></li>
                <!-- message Icon -->
                <li><a href="#"><i class="far fa-comment"></i></a></li>
                <!-- User Icon with Dropdown -->
                <li class="dropdown">
                    <a href="#" id="userIcon" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userIcon">
                        <?php if (!isset($_SESSION['user_logged_in'])): ?>
                            <li><a class="dropdown-item" href="login.php">Login/Register</a></li>
                        <?php else: ?>

                            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- main page  -->

    <div class="sidebar">
        <h2>Student Dashboard</h2>
        <ul>
            <li><a href="#" onclick="showSection('personal-info')">Personal Information</a></li>
            <li><a href="#" onclick="showSection('academic-info')">Academic Information</a></li>
            <li><a href="#" onclick="showSection('documents')">Documents</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to Your Dashboard</h1>
        <div id="personal-info" class="section">
            <h2>Personal Information</h2>
            
            <p><strong>Name:</strong> <?= htmlspecialchars($fullName) ?></p>
            <p><strong>Contact Number:</strong> <?= htmlspecialchars($contactNumber) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Date of Birth:</strong> <?= htmlspecialchars($dob) ?></p>
            <p><strong>Blood Group:</strong> <?= htmlspecialchars($bloodGroup) ?></p>
        </div>
        <div id="academic-info" class="section">
            <h2>Academic Information</h2>
            <p>Here you can see your academic details.</p>
        </div>
        <div id="documents" class="section">
            <h2>Documents</h2>
            <div class="documents">
                <h3>Uploaded Documents</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Example Document.pdf</td>
                            <td>
                                <button>Delete</button>
                            </td>
                        </tr>
                        <!-- Additional documents will be dynamically added here -->
                    </tbody>
                </table>
            </div>
            <div class="upload-section">
                <h3>Upload New Document</h3>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="document" required>
                    <button type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!--custom JS-->
    <script src="assets/js/dashboard.js"></script>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>