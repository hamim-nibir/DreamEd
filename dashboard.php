<?php
session_start();
require_once "/xampp/htdocs/DreamEd/partials/DBconnection.php";

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];
$user_type = $_SESSION['user_type'];

// Fetch user data
$sql = "SELECT * FROM $user_type WHERE uid = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Error fetching user data.";
    exit();
} else {
    $fullName = $user['first_name'] . " " . $user['last_name'];
    $email = $user['email'];
    $contactNumber = $user['contact_no'];
    if ($user_type == 'student') {
        $dob = $user['dob'];
        $bloodGroup = $user['blood_grp'];
    }
    if($user_type == 'faculty'){
        $designation = $user['designation'];
        $currentInstitute = $user['current_institute'];
        $researchInterest = $user['research_interest'];
    }
}

// Handle document upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName = basename($_FILES['document']['name']);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['document']['tmp_name'], $targetFilePath)) {
        $stmt = $conn->prepare("INSERT INTO documents (doc_name, doc_location, sid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $fileName, $targetFilePath, $uid);

        if ($stmt->execute()) {
            echo "<script>alert('File uploaded and saved to database successfully.');</script>";
        } else {
            echo "Database error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "File upload failed.";
    }
}

// Handle document deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_doc_id'])) {
    $docId = $_POST['delete_doc_id'];

    // Fetch the document path
    $docPathQuery = "SELECT doc_location FROM documents WHERE doc_id = ? AND sid = ?";
    $docPathStmt = $conn->prepare($docPathQuery);
    $docPathStmt->bind_param("ii", $docId, $uid);
    $docPathStmt->execute();
    $docPathResult = $docPathStmt->get_result();
    $doc = $docPathResult->fetch_assoc();

    if ($doc) {
        // Delete the file from the server
        if (file_exists($doc['doc_location'])) {
            unlink($doc['doc_location']);
        }

        // Delete the document record from the database
        $deleteQuery = "DELETE FROM documents WHERE doc_id = ? AND sid = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bind_param("ii", $docId, $uid);
        $deleteStmt->execute();
        $deleteStmt->close();

        echo "<script>alert('Document deleted successfully.');</script>";
    } else {
        echo "<script>alert('Document not found or unauthorized action.');</script>";
    }

    $docPathStmt->close();
}

$academicRecords = [];
if ($user_type === 'student') {
    $academicSql = "SELECT * FROM academic_background WHERE sid = ? ORDER BY academic_id DESC";
} else if ($user_type === 'alumni') {
    $academicSql = "SELECT * FROM academic_background WHERE fid = ? ORDER BY academic_id DESC";
} else if ($user_type === 'faculty'){
    $academicSql = "SELECT * FROM academic_background WHERE aid = ? ORDER BY academic_id DESC";
}

// fid = alumni id and aid = faculty id
$academicStmt = mysqli_prepare($conn, $academicSql);
    mysqli_stmt_bind_param($academicStmt, "i", $uid);
    mysqli_stmt_execute($academicStmt);
    $academicResult = mysqli_stmt_get_result($academicStmt);



while ($row = mysqli_fetch_assoc($academicResult)) {
    $academicRecords[] = $row;
}

mysqli_stmt_close($academicStmt);

// Fetch uploaded documents for the logged-in student
$uploadedDocuments = [];
$docSql = "SELECT * FROM documents WHERE sid = ? ORDER BY doc_id DESC";
$docStmt = mysqli_prepare($conn, $docSql);
mysqli_stmt_bind_param($docStmt, "i", $uid);
mysqli_stmt_execute($docStmt);
$docResult = mysqli_stmt_get_result($docStmt);

while ($row = mysqli_fetch_assoc($docResult)) {
    $uploadedDocuments[] = $row;
}

mysqli_stmt_close($docStmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    body {
      /* background-color: #ebbd3d; */
      background-color: #b3d9ff;
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
                <li><a href="universities.php"><i class="fas fa-search"></i></a></li>
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
                            <li><a class="dropdown-item" href="edit_profile.php"> Edit Profile</a></li>
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

    <!-- Sidebar and Main Content -->
    <div class="sidebar">
        <h2><?php echo strtoupper($user_type) ?> DASHBOARD</h2>
        <ul>
            <li><a href="#" onclick="showSection('personal-info')">Personal Information</a></li>
            <li><a href="#" onclick="showSection('academic-info')">Academic Information</a></li>
            <li><a href="#" onclick="showSection('documents')">Documents</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to Your Dashboard</h1>
        <!-- Personal Information Section -->
        <div id="personal-info" class="section">
            <h2>Personal Information</h2>
            <p><strong>Name:</strong> <?= htmlspecialchars($fullName) ?></p>
            <p><strong>Contact Number:</strong> <?= htmlspecialchars($contactNumber) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <?php if ($user_type === 'student'): ?>
                <p><strong>Date of Birth:</strong> <?= htmlspecialchars($dob) ?></p>
                <p><strong>Blood Group:</strong> <?= htmlspecialchars($bloodGroup) ?></p>
            <?php endif; ?>
            <?php if ($user_type === 'faculty'): ?>
                <p><strong>Designation:</strong> <?= htmlspecialchars($designation) ?></p>
            <p><strong>Institute:</strong> <?= htmlspecialchars($currentInstitute) ?></p>
            <p><strong>Research Interests:</strong> <?= htmlspecialchars($researchInterest) ?></p>
            <?php endif; ?>

        </div>
        <!-- Academic Information Section -->
        <div id="academic-info" class="section">
            <h2>Academic Information</h2>
            <?php if (!empty($academicRecords)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Degree</th>
                            <th>Institute</th>
                            <th>Start Year</th>
                            <th>End Year</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($academicRecords as $record): ?>
                            <tr>
                                <td><?= htmlspecialchars($record['degree']) ?></td>
                                <td><?= htmlspecialchars($record['institute']) ?></td>
                                <td><?= htmlspecialchars($record['start_year']) ?></td>
                                <td><?= htmlspecialchars($record['end_year']) ?></td>
                                <td><?= htmlspecialchars($record['grade']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No academic records found.</p>
            <?php endif; ?>
        </div>
        <!-- Documents Section -->
        <div id="documents" class="section">
            <h2>Documents</h2>
            <div class="upload-section">
                <h3>Upload New Document</h3>
                <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="document" required>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <h3>Uploaded Documents</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($uploadedDocuments)): ?>
                        <?php foreach ($uploadedDocuments as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc['doc_name']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($doc['doc_location']) ?>" class="btn btn-success" target="_blank">View</a>
                                    <form action="dashboard.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="delete_doc_id" value="<?= htmlspecialchars($doc['doc_id']) ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">No documents uploaded yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Custom JS -->
    <script src="assets/js/dashboard.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        // Show the first section by default
        showSection('personal-info');
    </script>
</body>

</html>