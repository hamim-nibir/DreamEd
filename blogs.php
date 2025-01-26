<?php
// index.php
session_start();
?>

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
  <!-- <link rel="stylesheet" href="assets/css/blogs.css"> -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    body {
      /* background-color: #ebbd3d; */
      background-color: #b3d9ff;
      font-family: 'Roboto', serif;
    }

    .navbar {
      position: relative;
    }

    .navbar-nav {
      gap: 30px;
    }

    .navbar-brand {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      margin-right: auto;
      font-weight: 800;
      color: #009970;
      font-size: 26px;
      transition: 0.3s color;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 15px;
      /* Space between icons */
      position: absolute;
      top: 20px;
      /* Adjust vertical positioning */
      right: 15px;
      /* Adjust horizontal positioning */
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .nav-right a {
      color: #000;
      /* Icon color */
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

    .nav-link {
      color: #666777;
      font-weight: 500;
      position: relative;
      transition: color 0.15s ease-in-out;
    }

    .nav-link:hover,
    .nav-link.active {
      color: #000;
    }

    .nav-link::before {
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

    .nav-link:hover::before,
    .nav-link.active::before {
      width: 100%;
      visibility: visible;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 16px;
      padding: 0% 10%;
      margin-top: 25px;
    }


    .container .card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .card img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .card h3 {
      font-size: 1.5rem;
      margin: 15px;
    }

    .card p {
      font-size: 1rem;
      margin: 0 15px 15px;
      color: #666;
    }

    .read-more {
      display: block;
      text-align: center;
      padding: 10px 15px;
      margin: 15px;
      background: #007BFF;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .read-more:hover {
      background: #0056b3;
    }


    /*new*/

    .optionbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      /* background-color: #ffffff; */
      background-color: #b3d9ff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .left ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 15px;
    }

    .left ul li a {
      text-decoration: none;
      color: #007BFF;
      font-size: 16px;
      padding: 5px 10px;
      border: 1px solid transparent;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .left ul li a:hover {
      color: #ffffff;
      background-color: #007BFF;
      border-color: #007BFF;
    }

    .right {
      display: flex;
      align-items: center;
    }

    .search-container {
      background-color: #ffffff;
      border-radius: 50px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 500px;
      max-width: 90%;
      margin-left: 20px;
      /* Increase this value to push it further right */
      height: 40px;
    }

    .search-container input[type="text"] {
      flex: 1;
      border: none;
      outline: none;
      padding: 10px 15px;
      font-size: 14px;
      border-radius: 50px 50px 50px 50px;
    }

    .search-container input[type="text"]::placeholder {
      color: #aaaaaa;
    }

    .search-container:hover {
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }




    /* Main postbar styling */
    .postbar {
      background-color: #b3d9ff;
      text-align: center;
      /* background-color: #f9f9f9; */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h3 {
      margin-bottom: 20px;
      font-family: Arial, sans-serif;
      font-weight: 600;
      color: #333;
    }

    .open-popup-btn {
      padding: 10px 20px;
      font-size: 16px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .open-popup-btn:hover {
      background-color: #0056b3;
    }

    /* Popup form container */
    .popup-form-container {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .popup-form-container:target {
      display: flex;
    }

    .popup-form {
      background-color: #ffffff;
      padding: 20px 30px;
      border-radius: 8px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      position: relative;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Form title */
    .form-title {
      margin-bottom: 15px;
      font-size: 20px;
      font-weight: 600;
      color: #333;
    }

    /* Close button */
    .close-popup-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 18px;
      color: #666;
      text-decoration: none;
      font-weight: bold;
    }

    .close-popup-btn:hover {
      color: #ff0000;
    }

    /* Form input and textarea styling */
    .form-group {
      text-align: left;
      margin-bottom: 15px;
    }

    label {
      font-size: 14px;
      font-weight: bold;
      color: #555;
      display: block;
      margin-bottom: 5px;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    textarea {
      resize: none;
      height: 100px;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Submit button styling */
    .submit-btn {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      color: #fff;
      background-color: #2688e4;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #0056b3;
    }


    .post-btn {
      padding: 10px 20px;
      font-size: 16px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .post-btn:hover {
      background-color: #0056b3;
    }


    .search_blog_button {
      display: inline-block;
      padding: 0.75em 1.5em;
      font-size: 1em;
      font-weight: bold;
      color: #ffffff;
      background-color: #007bff;
      border: none;
      border-radius: 0.25em;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
      margin-top: 20px;
      margin-left: 150px;
    }

    .cool-button {
      background: #009970;
      ;
      color: #fff;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(255, 117, 140, 0.3);
      display: inline-block;
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
              <a class="nav-link" href="index.php">Home</a>
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
              <a class="nav-link active" href="blogs.php">Blogs</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Right-side icons -->
      <ul class="nav-right">
        <!-- Search Icon -->
        <li><a href="universities.php"><i class="fas fa-search"></i></a></li>
        <!-- Message Icon -->
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
              <li><a class="dropdown-item" href="edit_profile.php">Profile</a></li>
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

  <!-- Option Bar -->
  <div class="optionbar">
    <div class="left">
      <form method="GET" action="">
        <ul>
          <li>
            <button class="cool-button" type="submit" name="tag" value="university_review">University Review</button>
          </li>
          <li>
            <button class="cool-button" type="submit" name="tag" value="job">Job</button>
          </li>
          <li>
            <button class="cool-button" type="submit" name="tag" value="accommodation">Accommodation</button>
          </li>
          <li>
            <button class="cool-button" type="submit" name="tag" value="recent">Recent</button>
          </li>
        </ul>
      </form>
    </div>



    <div class="right">
      <div class="search-container" style="display: flex; align-items: center;">
        <form method="GET" action="" style="display: flex; align-items: center; width: 100%;">
          <input type="text" name="search_query" placeholder="Search" required style="flex: 1; border-radius: 50px 0 0 50px; border: 1px solid #ddd; padding: 10px;">
          <button class="search_blog_button" type="submit" style="border-radius: 0 50px 50px 0; border: 1px solid #ddd; margin: 0; background-color: #007bff; color: white; padding: 10px 15px; cursor: pointer;">
            Search
          </button>
        </form>
      </div>
    </div>

  </div>

  <!-- Post Bar -->
  <div class="postbar">
    <h3>Share Your Blog</h3>
    <a href="#popupForm" class="open-popup-btn">Post a blog</a>

    <!-- Popup Form -->
    <div id="popupForm" class="popup-form-container">
      <div class="popup-form">
        <h3>Share Your Blog</h3>
        <form method="POST" action="submit_blog.php">
          <input type="text" name="blog_title" placeholder="Enter your blog title" class="post-title" required>
          <input type="text" name="tags" placeholder="Enter tags" class="post-title" required>
          <textarea name="blog_content" placeholder="Write your blog here..." class="post-content" required></textarea>
          <button type="submit" class="post-btn">Post</button>
          <!-- Cancel button -->
          <button type="button" class="post-btn cancel-btn">Cancel</button>
        </form>
      </div>
    </div>

    <!-- Main Content -->
    <div class="container">
      <?php
      require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";


      $sql =  " Select author , blog_title , blog_content from blog ";


      if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];
        $sql .= "WHERE blog_title like '%$searchQuery%' ";
      } else if (isset($_GET['tag'])) {
        $searchTerm = $_GET['tag'];

        switch ($searchTerm) {
          case 'university_review':
            $sql .= "WHERE tag = 'University Review' ";
            break;
          case 'job':
            $sql .= "WHERE tag = 'Job' ";
            break;
          case 'accommodation':
            $sql .= "WHERE tag = 'Accommodation' ";
            break;
          case 'recent':
            $sql .= "ORDER BY blog_id DESC";
            break;
          default:
            echo "Invalid selection.";
            exit;
        }
      }
      // echo $sql;

      $result = $conn->query($sql);

      $faculty_info = [];

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $faculty_info[] = $row;
        }
      } else {
        echo "0 results";
      }

      $conn->close();
      ?>
      <?php foreach ($faculty_info as $faculty_info): ?>
        <div class="card">
          <img src="assets/images/blogpic.jpg" alt="Blog Image">
          <h3><?php echo $faculty_info['blog_title']; ?></h3> <br>
          <h5><?php echo $faculty_info['author']; ?><h5>
              <p><?php echo $faculty_info['blog_content']; ?></p>
        </div>
      <?php endforeach; ?>


    </div>

    <!-- Custom JS -->
    <script>
      // Select the Cancel button
      const cancelBtn = document.querySelector('.cancel-btn');

      // Add event listener to the Cancel button
      cancelBtn.addEventListener('click', () => {
        // Redirect to blogs.php
        window.location.href = 'blogs.php';
      });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/index.js"></script>
</body>

</html>