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
    <link rel="stylesheet" href="/assets/css/reset_password.css">
    <title>Reset Password | DBMS</title>
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
                <a class="nav-link" href="/feed.php">Feed</a>
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
                <h1>Password Recovery</h1>
                <input type="text" class="form-control" name="otp" placeholder="OTP" required>
                <input type="password" class="form-control" name="new_password" placeholder="New Password" required>
                <input type="password" class="form-control" name="retype_new_password" placeholder="Retype new password" required>
                <button type="submit" name="submit">Change Password</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login_page.php" method="post">
                <h1>Password Recovery</h1>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
                <button>Send OTP</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Whoaaa!</h1>
                    <p>Check your mail for the OTP & create new password.</p>
                    <button class="hidden" id="login">Didn't Get It</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Oops!</h1>
                    <p>Forgot your password? Don't worry, provide your email address and get OTP to recover your password.</p>
                    <button class="hidden" id="register">Got It!</button>
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