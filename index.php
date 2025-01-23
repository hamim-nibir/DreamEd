<?php
// index.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | DreamEd</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/index.css">
  <style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
body{
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
    
    .hero-section {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  position: relative;
  background: url('assets/images/home-bg.jpg') no-repeat center center/cover;
  height: 100vh; 
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 20px;
}

.hero-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.01);
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
}


.hero-heading {
  color: #009970;
  /* color: red; */
  font-size: 3rem;
  margin: 0;
  font-weight: bold;
}

.hero-subtitle {
  font-size: 1.5rem;
  margin: 10px 0;
  color: black;
}

.animated-text {
  color: black;
  font-weight: bold;
  animation: fadeIn 1s ease-in-out;
}

.hero-description {
  color: black;
  font-size: 1.2rem;
  margin: 20px 0;
  max-width: 600px;
}

.hero-btn {
  background-color: #009970;
  color: #fff;
  padding: 10px 20px;
  font-size: 1rem;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.hero-btn:hover {
  background-color: #007a5c;
}

@keyframes fadeIn {
  from {
      opacity: 0;
  }
  to {
      opacity: 1;
  }
}
  </style>
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
              <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="universities.php">Universities</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="scholarships.php">Scholarships</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="preparations.php">Preparations</a>
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

  <div class="hero-section">
  <div class="hero-content">
    <h1 class="hero-heading">Welcome to DreamEd</h1>
    <h2 class="hero-subtitle">
      <span class="animated-text">Explore endless possibilities</span>
    </h2>
    <p class="hero-description">
      Discover opportunities, connect with others, and grow your potential. Join us to achieve more.
    </p>
    <a href="universities.php" class="hero-btn">Explore</a>
  </div>
</div>


    <script>
        const phrases = [
            "Explore endless possibilities",
            "Achieve your dreams",
            "Connect and grow with us"
        ];
        let index = 0;
        const animatedText = document.querySelector(".animated-text");

        setInterval(() => {
            index = (index + 1) % phrases.length;
            animatedText.textContent = phrases[index];
        }, 2000);
    </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="assets/js/index.js"></script>
</body>

</html>
