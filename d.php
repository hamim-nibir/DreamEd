<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .dashboard-header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            width: 100%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .profile-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-section img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-section h2 {
            margin: 10px 0;
        }

        .info-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
        }

        .info-section h3 {
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .info-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-section table th, .info-section table td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .info-section table th {
            background-color: #f4f4f9;
            font-weight: bold;
        }

        .upload-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            margin-top: 20px;
        }

        .upload-section input {
            margin-top: 10px;
        }

        footer {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="dashboard-header">Student Dashboard</div>

    <div class="dashboard-container">
        <div class="profile-section">
            <img src="default-profile.png" alt="Profile Picture">
            <h2>John Doe</h2>
            <p>Email: john.doe@example.com</p>
        </div>

        <div class="info-section">
            <h3>Personal Information</h3>
            <table>
                <tr>
                    <th>Full Name</th>
                    <td>John Doe</td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td>+123 456 7890</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>123 Main Street, City, Country</td>
                </tr>
                <tr>
                    <th>Previous Academic Results</th>
                    <td>High School: 90% | College: 85%</td>
                </tr>
            </table>
        </div>

        <div class="upload-section">
            <h3>Upload Documents</h3>
            <input type="file" id="upload-file">
            <button>Upload</button>
        </div>
    </div>

    <footer>&copy; 2024 Foreign Study Helpline</footer>
</body>
</html>
