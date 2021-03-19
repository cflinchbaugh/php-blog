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
            // Check if user already exists
            $sql = "SELECT user_name FROM users WHERE user_name=?"; //Only requesting the ID beause we really only care if any data is present, so no need to fetch the full row
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
                    function validateKeyUnique($conn, $newUserId) {
                        $sql = "SELECT * FROM user_id";
                        $result = mysqli_query($conn, $sql);
                        $keyExists = false;

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row["user_id"] === $newUserId) {
                                $keyExists = true;
                                break;
                            }
                        }

                        return $keyExists;
                    }

                    function generateKey($conn) {
                        $randomKey = uniqid('user');
                        $isUnique = validateKeyUnique($conn, $randomKey);

                        while ($isUnique === true) {
                            $randomKey = uniqid('user');
                            $isUnique = validateKeyUnique($conn, $randomKey);
                        }

                        return $randomKey;
                    }

                    function insertUser($conn, $userId, $username, $email, $password) {
                        $sql = "INSERT INTO users (user_id, user_name, user_email, user_password) values (?, ?, ?, ?)";

                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) { //Check if SQL is safe/valid
                            header("Location: ../signup.php?error=sqlerror".
                                "&username="."$username".
                                "&email="."$email"
                            );
                            
                            exit();
                        } else {
                            //Insert the user
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ssss", $userId, $username, $email, $hashedPassword); // Pass in user generated arguments
                            mysqli_stmt_execute($stmt); //execute
                        }
                    }

                    function insertProfileImage($conn, $userId) {
                        $sql = "INSERT INTO profile_image (user_id, status) VALUES (?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) { //Check if SQL is safe/valid
                            header("Location: ../signup.php?error=sqlerror".
                                "&userId="."$user_id"
                            );
                            
                            exit();
                        } else {
                            $profileStatus = 0;
                            mysqli_query($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "si", $userId, $profileStatus); // Pass in user generated arguments
                            mysqli_stmt_execute($stmt); //execute
                        }
                    }

                    $userId = generateKey($conn);

                    insertUser($conn, $userId, $username, $email, $password);
                    insertProfileImage($conn, $userId);

                }
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }