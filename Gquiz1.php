<!-- q_id = 2 -->

<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'student') {
    header('Location: login.php');
    exit;
}

require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";

// Fetch questions from the database
$q_id = 2;
$sql = "SELECT question_id, description, answer FROM question WHERE q_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $q_id);
$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $question) {
        $qid = $question['question_id'];
        $correctAnswer = $question['answer'];

        if (isset($_POST['answer_' . $qid]) && $_POST['answer_' . $qid] == $correctAnswer) {
            $score++;
        }
    }

    echo "<script>alert('Your total score is: $score');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz 1 | DreamEd</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/quiz1.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    body {
      /* background-color: #ebbd3d; */
      background-color: #deebee;
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

    <!-- main quiz  -->

    <div class="container mt-5">
        <h1 class="text-center mb-4">Brain Busters: General Knowledge Challenge</h1>
        <form method="POST">
        <?php foreach ($questions as $question): ?>
            <div>
                <p><?php echo htmlspecialchars($question['description']); ?></p>
                <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="A"> A<br>
                <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="B"> B<br>
                <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="C"> C<br>
                <input type="radio" name="answer_<?php echo $question['question_id']; ?>" value="D"> D<br>
            </div>
        <?php endforeach; ?>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Quiz</button>
            </div>
        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>