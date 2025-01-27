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
    require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";
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
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

/* * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
} */

body {
    /* font-family: 'Montserrat', sans-serif;
    margin: 0;
    padding: 0; */
    /* background: linear-gradient(to right, #e2e2e2, #c9d6ff); */
    background: #cef2e7;
}

/* navbar styles */
.navbar {
    position: relative;
  }
  .navbar-nav{
    gap: 30px;
  }
  .navbar-brand {
    margin-right: auto; /* Keeps the brand on the left */
    font-weight: 500;
    color: #009970;
    font-size: 24px;
    transition: 0.3s color;
  }
  
  .nav-right {
    display: flex;
    align-items: center;
    gap: 15px; /* Space between icons */
    position: absolute;
    top: 20px; /* Adjust vertical positioning */
    right: 15px; /* Adjust horizontal positioning */
    margin: 0;
    padding: 0;
    list-style: none;
  }
  
  .nav-right a {
    color: #000; /* Icon color */
    text-decoration: none;
    font-size: 1.2rem;
    transition: color 0.3s ease;
  }
  .nav-right a:hover {
    color: #666;
  }
  /* Dropdown menu styling */
  .dropdown-menu {
    width: 200px;
    padding: 10px;
  }
  
  .nav-link{
    color: #666777;
    font-weight: 500;
    position: relative;
    transition: color 0.15s ease-in-out;
  }
  .nav-link:hover, .nav-link.active{
    color: #000;
  }
  .nav-link::before{
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 2px;
    background-color: #009970;
    visibility: hidden;
    transition: width 0.15s ease-in-out, visibility 0s;
  }
  .nav-link:hover::before, .nav-link.active::before{
    width: 100%;
    visibility: visible;
  }
  
  /* login page styles */

.container {
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span {
    font-size: 12px;
}

.container a {
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button {
    background-color: #009970;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden {
    background-color: transparent;
    border-color: #fff;
}

.container form {
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input {
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container {
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in {
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in {
    transform: translateX(100%);
}

.sign-up {
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up {
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move {
    0%, 49.99% {
        opacity: 0;
        z-index: 1;
    }
    50%, 100% {
        opacity: 1;
        z-index: 5;
    }
}

.social-icons {
    margin: 20px 0;
}

.social-icons a {
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}

.toggle-container {
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container {
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle {
    background-color: #009970;
    height: 100%;
    /* background: linear-gradient(to right, #5c6bc0,#009970); */
    background: #009970;
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle {
    transform: translateX(50%);
}

.toggle-panel {
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left {
    transform: translateX(-200%);
}

.container.active .toggle-left {
    transform: translateX(0);
}

.toggle-right {
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right {
    transform: translateX(200%);
}

/* for radio buttons */
.user-type {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin: 10px 0;
}

.user-type label {
    font-size: 13px;
    font-weight: 500;
    color: #333;
    display: flex;
    align-items: center;
    gap: 5px;
}

.user-type input[type="radio"] {
    accent-color: #009970; /* Matches the theme color */
    width: 15px;
    height: 15px;
    margin-right: 5px;
}

  </style>
</head>

<body>
  
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