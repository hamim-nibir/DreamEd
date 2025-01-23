<?php
// index.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scholarships | DreamEd</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/scholarships.css">
  <link rel="stylesheet" href="assets/css/card.css">
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
              <a class="nav-link active" href="scholarships.php">Scholarships</a>
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
              <?php if ($_SESSION['user_type'] === 'student'): ?>
                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
              <?php elseif ($_SESSION['user_type'] === 'faculty' || $_SESSION['user_type'] === 'admin'): ?>
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <?php endif; ?>
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

  <!---navbarend--->


  <div class = unirows>
    

		<div class = "FilterAndSearch">	
			<div>
		  <div class="UniSearchbar">
			<h2>Find The Best Scholarships For Your Study</h2>
		</div> 
		
		<div class="search_container"> 
		  <div class="search"> 
			<div class="row"> 
			  <div class="col-md-6"> 
				<div class="search-1"> 
				  <i class='bx bx-search-alt'></i>
				  <form method="GET" action="">
				  <input type="text" name = "uni_query" placeholder="Search For Scholarships"> 
				  <button>Search</button>
				  
				</div> 
			  </div> 
			   
		</div> 
	  </div> 
	</div> 
	<div class="countries_dropdown">
	  <input type="text" name = "country_query" id="selectedItemsTextbox" autocomplete="off">
	  <button class="countries_dropdown-button">Select Countries</button>
	  </form>
    <div class = "resultbox">
    
    </div>
	  
	  <div class="countries_dropdown-content">
	  </div>

    <script src="DreamEd/choices.min.js"></script>

	</div>

<form  method = "POST" action="">
  <div class = "tickbox">
	  <label class="tickbox_container">Undergraduate
		<input type="checkbox" name ="UG" >
		<span class="checkmark"></span>
	  </label>
	
	
	
	  <label class="tickbox_container">Postgraduate
		<input type="checkbox" name = "PG" >
		<span class="checkmark"></span>
	  </label>
	  
	
	  </div>
  
    <div>
		<div class="slidecontainer">
		  <style> .left-margin-for-acceptancerate { margin-left: 40px ; margin-top: 10px; font-size: 20px; }
		  </style>
			<p class="left-margin-for-acceptancerate">Amount: <span id="demo"></span></p>
		  <input type="range"  name = "rng" min="1" max="100000" value="50000" class="slider" id="myRange">
		</div>
		</div>
		
	<script>
		var slider = document.getElementById("myRange");
	var output = document.getElementById("demo");
	output.innerHTML = slider.value; // Display the default slider value
	
	// Update the current slider value (each time you drag the slider handle)
	slider.oninput = function() {
	  output.innerHTML = this.value;
	}
	</script>

	<div>
		<button class = "shei" name = "filter_search" > Filter Search </button>
	</div>	
</form>

</div>
	</div>
  </div>
	



	<section class = cardbody>

	<section class="light">
		<div class="container py-2">
			<div class="h1 text-center text-dark" id="pageHeaderTitle">Scholarships</div>
	
			
		<?php
		
		require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";
		
		$uni_query = isset($_GET['uni_query']) ? $_GET['uni_query'] : '';

		$country_query = isset($_GET['country_query']) ? $_GET['country_query'] : '';

		$rng = isset($_POST['rng']) ? (double)$_POST['rng'] : 0;
 
		$sql = "SELECT name, ammount, description, image_url, scholarship_url , country FROM scholarship";
		
		if (!empty($uni_query) && empty($country_query)) {
			$uni_query = $conn->real_escape_string($uni_query);
			$sql .= " WHERE name LIKE '%$uni_query%'";
		}
		else if (empty($uni_query) && !empty($country_query)){
			$country_query = $conn->real_escape_string($country_query);
			$sql .= " WHERE country LIKE '%$country_query%'";
		}
		else if(!empty($uni_query) && !empty($country_query)){
			$country_query = $conn->real_escape_string($country_query);
			$uni_query = $conn->real_escape_string($uni_query);
			$sql .= " WHERE name LIKE '%$uni_query%' AND  country LIKE '%$country_query%' ";
		}

		if ( ( !empty($uni_query) || !empty($country_query) ) && $rng > 0 ){
			 $rng = $conn->real_escape_string($rng); 
			 $sql .= " AND acceptance_rate <= $rng";
		}
		else if(empty($uni_query)==true && empty($country_query)==true && $rng > 0 ){
			$rng = $conn->real_escape_string($rng); 
			$sql .= " WHERE acceptance_rate <= $rng";
		}
		

		
		
		
		$result = $conn->query($sql);
		
		$universities = [];
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
        $row['image_url'] = 'data:image/jpeg;base64,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';
				$universities[] = $row;
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
		
		<?php foreach ($universities as $university): ?>
    <article class="postcard light blue">
        <a class="postcard__img_link" href="#">
            <img class="postcard__img" src="<?php echo $university['image_url']; ?>" alt="Image Title" />
        </a>
        <div class="postcard__text t-dark">
            <h1 class="postcard__title blue"><a href="#"><?php echo $university['name']; ?></a></h1>
            <div class="postcard__subtitle small">
                <text datetime="">
                    <i class="fas fa-map-marker-alt mr-2"></i><?php echo $university['country']; ?>
                </text>
            </div>
            <div class="postcard__bar"></div>
            <div class="postcard__preview-txt"><?php echo $university['description']; ?></div>
            <ul class="postcard__tagbox">
                <!-- Assuming there's a `tags` column -->
                <?php if (isset($university['tags'])): ?>
                    <?php foreach (explode(',', $university['tags']) as $tag): ?>
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $tag; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li class="tag__item play blue">
                    <a href= "<?php echo $university['scholarship_url']; ?>"> <i class="fas fa-play mr-2"></i>See More</a>
                </li>
				<li class="tag__item"><i class="fas fa-clock mr-2"></i>Scholarship Ammount<?php echo $university['ammount']; ?>%</li>
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
</body>

</html>