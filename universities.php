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
              <a class="nav-link active" href="universities.php">Universities</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="scholarships.php">Scholarships</a>
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
			<h2>Find The Best Destination For Your Study</h2>
		</div> 
		
		<div class="search_container"> 
		  <div class="search"> 
			<div class="row"> 
			  <div class="col-md-6"> 
				<div class="search-1"> 
				  <i class='bx bx-search-alt'></i>
				  <input type="text" placeholder="UX Designer"> 
				  <button>Search</button>
				</div> 
			  </div> 
			   
		</div> 
	  </div> 
	</div> 
	<div class="countries_dropdown">
	  <input type="text" id="selectedItemsTextbox" autocomplete="off">
	  <button class="countries_dropdown-button">Select Countries</button>
    <div class = "resultbox">
    
    </div>
	  
	  <div class="countries_dropdown-content">
	  </div>

    <script src="DreamEd/choices.min.js"></script>

	</div>

  <div class = "tickbox">
	  <label class="tickbox_container">Under Graduate
		<input type="checkbox" >
		<span class="checkmark"></span>
	  </label>
	
	
	
	  <label class="tickbox_container">Post Graduate
		<input type="checkbox" >
		<span class="checkmark"></span>
	  </label>
	  
	
	  </div>
  
    <div>
		<div class="slidecontainer">
		  <style> .left-margin-for-acceptancerate { margin-left: 20px ; margin-top: 10px; font-size: 20px; }
		  </style>
			<p class="left-margin-for-acceptancerate">Acceptance Rate: <span id="demo"></span></p>
		  <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
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


	</div>
	</div>
  </div>
	



	<section class = cardbody>

	<section class="light">
		<div class="container py-2">
			<div class="h1 text-center text-dark" id="pageHeaderTitle">Universities</div>
	
			
		<?php
		
  		require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";	

		$sql = "SELECT img_url, title, preview_txt, tags FROM articles";
		$result = $conn->query($sql);
		
		$articles = [];

		if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
				$row['tags'] = explode(',', $row['tags']); // Assuming tags are stored as a comma-separated string
				$articles[] = $row;
			}
		} else {
			echo "0 results";
		}
		$conn->close();
		?>
		
		<?php foreach ($articles as $article): ?>
				<article class="postcard light blue">
					<a class="postcard__img_link" href="#">
						<img class="postcard__img" src="<?php echo $article['img_url']; ?>" alt="Image Title" />
					</a>
					<div class="postcard__text t-dark">
						<h1 class="postcard__title blue"><a href="#"><?php echo $article['title']; ?></a></h1>
						<div class="postcard__subtitle small">
							<time datetime="<?php echo $article['datetime']; ?>">
								<!-- <i class="fas fa-calendar-alt mr-2"></i><?php echo $article['date']; ?> -->
							</time>
						</div>
						<div class="postcard__bar"></div>
						<div class="postcard__preview-txt"><?php echo $article['preview_txt']; ?></div>
						<ul class="postcard__tagbox">
							<?php foreach ($article['tags'] as $tag): ?>
								<li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $tag; ?></li>
							<?php endforeach; ?>
							<li class="tag__item play blue">
								<a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
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
</body>

</html>
