<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loginpage.css">
    <title>Login/Register | DBMS</title>
    <!--Tab Icon-->
    <link rel="shortcut icon" href="" type="image/svg+xml">
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg bg-body-transparent">
        <div class="container-fluid">
          <a class="navbar-brand" href="/index.php">
            <img class="brandlogo" src="/assets//images/placeholderlogo.png" alt="LOGO">
          </a>  <!--Added an reference placeholder logo image-->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/blogs.php">Blogs</a>
              </li>
            </ul>
            <div class="nav-right">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">  <!--Added tooltip for icons without text-->
                  <div class="nav-right-icons">
                    <li class="nav-right-items"><i class="fa-solid fa-magnifying-glass fa-lg"></i> <span class = "tooltiptext">Search</span></li>
                  </div>
                  <div class="nav-right-icons">
                    <li class="nav-right-items"><i class="fa-regular fa-message fa-lg"></i><span class = "tooltiptext">Messages</span></li>
                  </div>
                  <div class="nav-right-icons">  
                    <li class="nav-right-items"><i class="fa-regular fa-user fa-lg"></i><span class = "tooltiptext">Profile</span></li>
                  </div>
                </ul>
            </div>
          </div>
        </div>
      </nav>
    <!-- Navbar -->

    <div class="container" id="container">
        <div class="form-container sign-up">
        <?php require 'partials/registration.php' ?>
            <form action="login_page.php" method="post">
                <h1>Create Account</h1>
                <input type="text" class="form-control" name="username" placeholder="Username" required>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <input type="password" class="form-control" name="retype_password" placeholder="Retype Password" required>
                <button type="submit" name="submit">Register</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login_page.php" method="post">
                <h1>Login</h1>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <input type="password"  class="form-control" name="password" placeholder="Password" required>
                <a href="/reset_password.php">Forgot Password?</a>
                <button>Login</button>
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