<?php
session_start();
require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];
$user_type = $_SESSION['user_type'];

// Fetch user data
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
    if ($user_type == 'student') {
        $dob = $user['dob'];
        $bloodGroup = $user['blood_grp'];
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <style>
        .section {
            display: none;
        }

        .active-section {
            display: block;
        }
    </style>
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
                            <a class="nav-link" href="index.php">Home</a>
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
                            <li><a class="dropdown-item" href="profile.php"> Edit Profile</a></li>
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

    <!-- Sidebar and Main Content -->
    <div class="sidebar">
        <h2>Edit Profile</h2>
        <ul>
            <li><a href="#" onclick="showSection('personal-info')">Personal Information</a></li>
            <li><a href="#" onclick="showSection('academic-info')">Academic Information</a></li>
        </ul>
    </div>
    <div class="content">
        <!-- Personal Information Section -->
        <div id="personal-info" class="section">
            <h1>Personal Information</h1>
            <form action="update_personal_info.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter your first name">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter your last name">
                </div>
                <div class="mb-3">
                    <input type="tel" class="form-control" id="contactNo" name="contact_no" placeholder="Enter your contact number">
                </div>
                <div class="mb-3">
                    <input type="date" class="form-control" id="dob" name="dob">
                </div>
                <div class="mb-3">
                    <select class="form-select" id="bloodGroup" name="blood_group">
                        <option value="" disabled selected>Select your blood group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
                <button type="submit" class="btn btn-primary w-100">Update</button>
            </form>
        </div>
        <!-- Academic Information Section -->
        <div id="academic-info" class="section">
            <h1>Academic Information</h1>
            <form action="add_academic_info.php" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="degree" name="degree" placeholder="Enter your degree" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="institute" name="institute" placeholder="Enter your institute" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="startYear" name="start_year" placeholder="Enter start year (e.g., 2020)" required min="1900" max="2099">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" id="endYear" name="end_year" placeholder="Enter end year (e.g., 2024)" required min="1900" max="2099">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="grade" name="grade" placeholder="Enter your grade (e.g., GPA or percentage)" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </form>
        </div>
    </div>

    <script>
        // Function to switch between sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active-section'));
            document.getElementById(sectionId).classList.add('active-section');
        }

        // Default section to display
        document.addEventListener("DOMContentLoaded", () => {
            showSection('personal-info');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-sdBVZng9lMhlMa5dvPzlk+xEvXh55D4B4Fs7TtplavRRMlfQt+yt09Nxd5/5I2bE" crossorigin="anonymous"></script>
</body>

</html>
