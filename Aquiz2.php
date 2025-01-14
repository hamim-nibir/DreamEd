<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 1 | DreamEd</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/quiz1.css">
</head>

<body>
    <!-- Navbar -->
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
                            <a class="nav-link active" href="preparations.php">Preparations</a>
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

    <!-- main quiz  -->

    <div class="container mt-5">
        <h1 class="text-center mb-4">Numerical Ability Test</h1>
        <form action="quiz1_result.php" method="POST">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <div class="mb-4">
                    <p><strong>Question <?php echo $i; ?>:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q<?php echo $i; ?>" value="A" id="q<?php echo $i; ?>a" required>
                        <label class="form-check-label" for="q<?php echo $i; ?>a">Option A</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q<?php echo $i; ?>" value="B" id="q<?php echo $i; ?>b">
                        <label class="form-check-label" for="q<?php echo $i; ?>b">Option B</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q<?php echo $i; ?>" value="C" id="q<?php echo $i; ?>c">
                        <label class="form-check-label" for="q<?php echo $i; ?>c">Option C</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="q<?php echo $i; ?>" value="D" id="q<?php echo $i; ?>d">
                        <label class="form-check-label" for="q<?php echo $i; ?>d">Option D</label>
                    </div>
                </div>
            <?php endfor; ?>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Quiz</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>