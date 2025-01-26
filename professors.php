<?php
    	if (isset($_GET['uni_name'])) {
            // Get the value from the query parameter
            $uni_name = $_GET['uni_name'];
        } else {
          header("Location: universities.php");
          exit();
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Universities | DreamEd</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/universities.css">
  <link rel="stylesheet" href="assets/css/card.css">
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    body {
      font-family: 'Roboto', serif;
      background: url('assets/images/home-bg.jpg') no-repeat center center/cover;
      /* background: #007bff; */
    }

    .navbar-brand {
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      margin-right: auto;
      /* Keeps the brand on the left */
      font-weight: 800;
      color: #009970;
      font-size: 26px;
      transition: 0.3s color;
    }

    .search-1 button {
      position: absolute;
      right: 0px;
      top: 0px;
      border: none;
      height: 45px;
      background-color: #009970;
      color: #fff;
      width: 90px;
      border-radius: 4px
    }

    .countries_dropdown-button {
      /* background-color: #009970;
      color: white;
      padding: 12px;
      font-size: 15px;
      border: none;
      cursor: pointer;
      margin-left: 80.35%;
      vertical-align: top;
      margin-top: -55px; */
      position: absolute;
      right: 0px;
      top: 0px;
      border: none;
      height: 45px;
      background-color: #009970;
      color: #fff;
      width: 90px;
      border-radius: 4px
    }

    .shei {
      background-color: #009970;
      color: white;
      padding: 12px;
      font-size: 15px;
      border: none;
      cursor: pointer;
      margin-left: 45%;
      vertical-align: top;
      margin-top: 5px;
      margin-bottom: 5px;
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
              <a class="nav-link" href="blogs.php">Blogs</a>
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
            <!-- Logged-out menu -->
            <div id="loggedOutMenu" class="d-none">
              <li><a class="dropdown-item" href="login.php">Login/Register</a></li>
            </div>
            <!-- Logged-in menu -->
            <div id="loggedInMenu" class="d-none">
              <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="settings.php">Settings</a></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </div>
          </ul>
        </li>
      </ul>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>


  <div class = unirows>
    

		<div class = "FilterAndSearch">	
			<div>
		  <div class="UniSearchbar">
			<h2>Find The Best Professors For Your Study</h2>
		</div> 
		
		<div class="search_container"> 
		  <div class="search"> 
			<div class="row"> 
			  <div class="col-md-6"> 
				<div class="search-1"> 
				  <i class='bx bx-search-alt'></i>
				  <form method="GET" action="">
          <input type="hidden" name="uni_name" value="<?php echo htmlspecialchars($uni_name); ?>">
          <input type="text" name="faculty_name" placeholder="Search by Name">
          <button type="submit">Search</button>
          </form>
				</div> 
			  </div> 
			   
		</div> 
	  </div> 
	</div> 
  	<div class="countries_dropdown">
      <form method="GET" action="">
      <input type="hidden" name="uni_name" value="<?php echo htmlspecialchars($uni_name); ?>">
  
	  <input type="text" name = "research_query" id="selectedItemsTextbox" autocomplete="off" placeholder="Search by research field">
	  <button class="countries_dropdown-button">Search</button>
	  </form>
    <div class = "resultbox">
    
    </div>
	  
	  <div class="countries_dropdown-content">
	  </div>

	  
	  <div class="countries_dropdown-content">
	  </div>

    <script src="DreamEd/choices.min.js"></script>

	</div>



</div>
	</div>
  </div>


	<section class = cardbody>

	<section class="light">
		<div class="container py-2">
			<div class="h1 text-center text-dark" id="pageHeaderTitle">Professors</div>
	
			
		<?php
		
		require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";
	
  
		$faculty_query = isset($_GET['faculty_name']) ? $_GET['faculty_name'] : '';
    
		$research_q = isset($_GET['research_query']) ? $_GET['research_query'] : '';
  
  
		$sql = "SELECT username , email , first_name , last_name , profile_picture , designation ,research_interest From faculty WHERE uid IN (SELECT aid FROM academic_background WHERE institute = '$uni_name' AND aid IS NOT NULL)";

if (!empty($faculty_query) && empty($research_q)) {
  $faculty_query = $conn->real_escape_string($faculty_query);
  $sql .= " AND first_name LIKE '%$faculty_query%'";
}
else if (empty($faculty_query) && !empty($research_q)){
  $research_q = $conn->real_escape_string($research_q);
  $sql .=  " AND research_interest LIKE '%$research_q%'";
}
else if(!empty($faculty_query) && !empty($research_q)){
  $research_q = $conn->real_escape_string($research_q);
  $faculty_query = $conn->real_escape_string($faculty_query);
  $sql .= " AND first_name LIKE '%$faculty_query%' AND  research_interest LIKE '%$faculty_query%' ";
}





		$result = $conn->query($sql);
		
		$faculty_info = [];
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$faculty_info[] = $row;
			}


		} else {
			echo "0 results";
		}
		$conn->close();
		?>
		
		<?php foreach ($faculty_info as $faculty_info): ?>
    <article class="postcard light blue">
        <a class="postcard__img_link" href="#">
            <img class="postcard__img" src="<?php echo $faculty_info['profile_picture']; ?>" alt="Image Title" />
        </a>
        <div class="postcard__text t-dark">
            <h1 class="postcard__title blue"><a href="#"><?php echo $faculty_info['first_name']; ?>  <?php echo $faculty_info['last_name']; ?></a></h1>
            <div class="postcard__subtitle small">
                <time datetime="">
                    <i class="fas fa-map-marker-alt mr-2"></i><?php echo $faculty_info['designation']; ?>, <?php echo $uni_name ?>
                </time>
            </div>
            <div class="postcard__bar"></div>
            <div class="postcard__preview-txt"><?php echo $faculty_info['research_interest']; ?></div>
            <ul class="postcard__tagbox">
                <!-- Assuming there's a `tags` column -->
                <?php if (isset($faculty_info['tags'])): ?>
                    <?php foreach (explode(',', $faculty_info['tags']) as $tag): ?>
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $tag; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <li class="tag__item play blue">Contact Info    <?php echo $faculty_info['email']; ?>
                </li>
				            </ul>
        </div>
    </article>
<?php endforeach; ?>

		
		</div>
	</section>
	</section>
	</div>
	



  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="assets/js/index.js"></script>
  <script src="/"></script>
</body>

</html>