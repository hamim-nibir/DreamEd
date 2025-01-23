<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/login.css">
  <title>Login/Register | DreamEd</title>
  <!--Tab Icon-->
  <link rel="shortcut icon" href="" type="image/svg+xml">
</head>

<body>
  <!-- backend code  -->
  <!-- registration  -->
  <?php
  if (isset($_POST["submit"])) {
    session_start();
    $userName = $_POST["username"];
    $Email = $_POST["email"];
    $Password = $_POST["password"];
    $Retype_password = $_POST["retype_password"];
    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);
    $user_type = $_POST["user_type"];

    require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";

    // Validate user type to prevent SQL injection
    $allowed_tables = ["student", "faculty", "alumni"];
    if (!in_array($user_type, $allowed_tables)) {
      echo "<script>alert('Invalid user type');</script>";
      exit();
    }

    // Check for duplicate username or email
    $sql = "SELECT * FROM `$user_type` WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
      echo "<script>alert('Failed to prepare query');</script>";
      exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $userName, $Email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      echo "<script>alert('Username or Email already exists');</script>";
    } else if (strlen($Password) < 8) {
      echo "<script>alert('Password must be at least 8 characters');</script>";
    } else if ($Password != $Retype_password) {
      echo "<script>alert('Password and Retype password must be the same');</script>";
    } else {
      // Insert new user into the appropriate table
      $sql = "INSERT INTO `$user_type` (username, email, password) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $userName, $Email, $passwordHash);
        mysqli_stmt_execute($stmt);
        echo "<script>alert('Registration Successful!');</script>";
      } else {
        echo "<script>alert('Something went wrong during registration');</script>";
      }
    }
  }

  // login
  if (isset($_POST['btn_login'])) {
    session_start();
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $UserType = $_POST["user_type"];

		require_once "/opt/lampp/htdocs/university/DreamEd/partials/DBconnection.php";
    $tableName = $UserType;

    // Check student table
    $sql = "SELECT * FROM $tableName WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($Password, $user['password'])) {
      $_SESSION['user_logged_in'] = true;
      $_SESSION["user_type"] = $UserType;
      $_SESSION['uid'] = $user['uid'];
      $_SESSION['username'] = $user['username'];
      header("Location: index.php");
      echo "<script>alert('Logged in successfully!');</script>";
      exit();
    } else {
      echo "<script>alert('Invalid email or password');</script>";
    }
  }

  ?>


  <!-- frontend code  -->
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

  <!-- Login Page -->

  <div class="container" id="container">
    <div class="form-container sign-up">
      <form action="login.php" method="post">
        <h1>Create Account</h1>
        <input type="text" class="form-control" name="username" placeholder="Username" required>
        <input type="email" class="form-control" name="email" placeholder="Email" required>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <input type="password" class="form-control" name="retype_password" placeholder="Retype Password" required>
        <!-- User type selection -->
        <div class="user-type">
          <label>
            <input type="radio" name="user_type" value="student" required /> Student
          </label>
          <label>
            <input type="radio" name="user_type" value="faculty" required /> Faculty
          </label>
          <label>
            <input type="radio" name="user_type" value="alumni" required /> Alumni
          </label>
        </div>

        <button type="submit" name="submit">Register</button>
      </form>
    </div>
    <div class="form-container sign-in">
      <form action="login.php" method="post">
        <h1>Login</h1>
        <input type="email" class="form-control" name="email" placeholder="Email" required>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <select name="user_type" class="form-select" required>
          <option value="student">Student</option>
          <option value="faculty">Faculty</option>
          <option value="alumni">Alumni</option>
        </select>
        <a href="/reset_password.php">Forgot Password?</a>
        <button type="btn_login" name="btn_login">Login</button>
      </form>
    </div>
    <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>Welcome!</h1>
          <p>Already have an account? Sign in.</p>
          <button class="hidden" id="login">Sign In</button>
        </div>
        <div class="toggle-panel toggle-right">
          <h1>Welcome!</h1>
          <p>Don't have an account? Sign up with your personal details to get all the services.</p>
          <button class="hidden" id="register">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <!--custom JS-->
  <script src="assets/js/loginpage.js"></script>

  <!--Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>