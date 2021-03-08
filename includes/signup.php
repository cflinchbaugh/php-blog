<?php
    if (!isset($_POST['signup-submit'])) {
        // User hit URL directly rather than submitted a form
        header("Location: ../signup.php");
    } else {
        require 'dbh.php';

        $username = $_POST['user-name'];
        $email = $_POST['user-email'];
        $password = $_POST['user-password'];
        $passwordRepeat = $_POST['user-password-repeat'];

        //Any/all input validation, basic examples here:
        if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
            header("Location: ../signup.php?error=emptyfields".
                "&username="."$username".
                "&email="."$email"
            );

            exit();

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invalidUsernameAndEmail");
            
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?error=invalidEmail".
                "&username="."$username"
            );
            
            exit();
        } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: ../signup.php?error=invalidUsername".
                "&email="."$email"
            );
            
            exit();
        } else if ($password !== $passwordRepeat) {
            header("Location: ../signup.php?error=passwordRepeat".
                "&username="."$username".
                "&email="."$email"
            );
            
            exit();
        } else {
            $sql = "SELECT user_id FROM users WHERE user_id=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) { //Check if SQL is safe/valid
                header("Location: ../signup.php?error=sqlerror".
                    "&username="."$username".
                    "&email="."$email"
                );
                
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username); // Pass in user generated arguments

                mysqli_stmt_execute($stmt); //execute

                mysqli_stmt_store_result($stmt);  //save the result to $stmt

                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0) {
                    header("Location: ../signup.php?error=usernameTaken".
                        "&email="."$email"
                    );
                    exit();
                } else {
                    $sql = "INSERT INTO users (user_name, user_email, user_password) values (?, ?, ?)";

                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) { //Check if SQL is safe/valid
                        header("Location: ../signup.php?error=sqlerror".
                            "&username="."$username".
                            "&email="."$email"
                        );
                        
                        exit();
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword); // Pass in user generated arguments

                        mysqli_stmt_execute($stmt); //execute
        
                        header("Location: ../signup.php?signup=success".
                    
                            "&username="."$username".
                            "&email="."$email".
                            "&password="."$password"
                        );
                        
                        exit();
                    }
                }
            }

        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }