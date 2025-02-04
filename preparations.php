<?php
// index.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preparations | DreamEd</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/preparations.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    body {
      /* background-color: #ebbd3d; */
      background-color: #b3d9ff;
      font-family: 'Roboto', serif;
    }

    .navbar-brand {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      margin-right: auto;
      font-weight: 800;
      color: #009970;
      font-size: 26px;
      transition: 0.3s color;
    }
  </style>
</head>

<body>
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
              <a class="nav-link" href="scholarships.php">Scholarships</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="preparations.php">Preparations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blogs.php">Blogs</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Right-side icons -->
      <ul class="nav-right">
        <!-- Search Icon -->
        <li><a href="universities.php"><i class="fas fa-search"></i></a></li>
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
              <li><a class="dropdown-item" href="edit_profile.php">Edit Profile</a></li>
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

  <!-- Main Content -->
  <div class="content">
    <h1 class="section-heading">Choose a Category</h1>
    <div class="card-container">
      <!-- Aptitude Test Card -->
      <div class="card">
        <img src="assets/images/a.jpg" alt="Aptitude Test" class="card-img">
        <h3 class="card-title">Aptitude Test</h3>
        <p class="card-subtitle">Sharpen your logical reasoning skills</p>
        <a href="aptitude.php" class="card-btn">Let's Go</a>
      </div>
      <!-- General Knowledge Card -->
      <div class="card">
        <img src="assets/images/gk2.png" alt="General Knowledge" class="card-img">
        <h3 class="card-title">General Knowledge</h3>
        <p class="card-subtitle">Stay updated with the world</p>
        <a href="gk.php" class="card-btn">Let's Go</a>
      </div>
      <!-- Vocabulary Card -->
      <div class="card">
        <img src="assets/images/vocab.jpg" alt="Vocabulary" class="card-img">
        <h3 class="card-title">Vocabulary</h3>
        <p class="card-subtitle">Expand your word bank</p>
        <a href="vocabulary.php" class="card-btn">Let's Go</a>
      </div>
      <!-- Grammar Card -->
      <div class="card">
        <img src="assets/images/grammer.jpg" alt="Grammar" class="card-img">
        <h3 class="card-title">Grammar</h3>
        <p class="card-subtitle">Master the rules of language</p>
        <a href="grammar.php" class="card-btn">Let's Go</a>
      </div>
      <!-- Math Card -->
      <div class="card">
        <img src="assets/images/math.jpg" alt="Math" class="card-img">
        <h3 class="card-title">Math</h3>
        <p class="card-subtitle">Improve your problem-solving skills</p>
        <a href="math.php" class="card-btn">Let's Go</a>
      </div>
    </div>
  </div>



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="assets/js/index.js"></script>
</body>

</html>