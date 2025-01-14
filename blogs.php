<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogs | DreamEd</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/blogs.css">
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
              <a class="nav-link" href="preparations.php">Preparations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="blogs.php">Blogs</a>
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

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="assets/js/index.js"></script>
</body>

</html>
