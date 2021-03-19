<?php
    if (!isset($_POST['login-submit'])) {
        // User hit URL directly rather than submitted a form
        header("Location: ../index.php");
        exit();
    } else {
        require 'dbh.php';
        require "../header.php"; //Session data

        $username = $_POST['user-name'];
        $password = $_POST['user-password'];

        //Any/all input validation, basic examples here:
        if (empty($username) || empty($password)) {
            header("Location: ../index.php?error=emptyfields".
                "&username="."$username"
            );

            exit();

        } else {
            $sql = "SELECT * FROM users WHERE user_name=?";
            $stmt = mysqli_stmt_init($conn); //Grabs connection from dbh.php

            if (!mysqli_stmt_prepare($stmt, $sql)) { //Check if SQL is safe/valid
                header("Location: ../index.php?error=sqlerror".
                    "&username="."$username"
                );

                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username); // Pass in user generated arguments
                mysqli_stmt_execute($stmt); //execute

                $result = mysqli_stmt_get_result($stmt);  //save the result to $stmt

                if ($row = mysqli_fetch_assoc($result)) {
                    $passwordCheck = password_verify($password, $row['user_password']);

                    if (!$passwordCheck) {
                        header("Location: ../index.php?error=invalidlogin".
                            "&username="."$username"
                        );
                        
                        exit();
                    } else if ($passwordCheck === true) {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['user_email'] = $row['user_email'];

                        header("Location: ../index.php?login=success".
                            "&username="."$username"
                        );
                        
                        exit();
                    }
                } else {
                    header("Location: ../index.php?error=invalidlogin".
                        "&username="."$username"
                    );
                    
                    exit();
                }
            }

        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }