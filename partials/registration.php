<?php
                if(isset($_POST["submit"])){
                    $userName = $_POST["username"];
                    $Email = $_POST["email"];
                    $Password = $_POST["password"];
                    $Retype_password = $_POST["retype_password"];
                    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);

                    require_once "database.php";
                    $sql = "SELECT * FROM users WHERE email = '$Email'";
                    $result = mysqli_query($conn, $sql);
                    $rowCount = mysqli_num_rows($result);
                    if($rowCount>0){
                        require_once 'partials/popups/popup_email.php';
                    }
                    else if(strlen($Password) < 8){
                        require_once 'partials/popups/popup_password.php';
                    }
                    else if($Password != $Retype_password){
                        require_once 'partials/popups/popup_repassword.php';
                    }
                    else{
                        $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        $prepareStmt= mysqli_stmt_prepare($stmt, $sql);
                        if($prepareStmt){
                            mysqli_stmt_bind_param($stmt, "sss", $userName, $Email, $passwordHash);
                            mysqli_stmt_execute($stmt);
                                require_once 'partials/popups/popup_success.php';
        
                        }
                        else{
                            die("Something went wrong");
                        }
                    }
                }
            ?>