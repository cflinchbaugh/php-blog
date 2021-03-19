<?php
    require "../header.php";

    if (!isset($_POST['article-create-submit']) || empty($_SESSION['user_id'])) {
        // User hit URL directly rather than submitted a form
        header("Location: ../article_create.php?error=invalidEntry");
    } else {
        echo "ID: ";
        echo $_SESSION['user_id'];
        require 'dbh.php';

        $title = $_POST['title'];
        $message = $_POST['message'];

        //Any/all input validation, basic examples here:
        if (empty($title) || empty($message)) {
            header("Location: ../article_create.php?error=emptyfields".
                "&title="."$title".
                "&message="."$message"
            );

            exit();
        } else {
            // Grab the Author and date
            $author = $_SESSION['user_id'];
            $date = date("Y-m-d H:i:s");

            $sqlInsertArticle = "INSERT INTO article (article_title, article_text, article_author, article_date) values (?, ?, ?, ?)";
            $stmtInsertArticle = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmtInsertArticle, $sqlInsertArticle)) { //Check if SQL is safe/valid
                header("Location: ../article_create.php?error=sqlerror".
                    "&title="."$title".
                    "&message="."$message"
                );
                
                exit();
            } else {
                mysqli_stmt_bind_param($stmtInsertArticle, "ssss", $title, $message, $author, $date); // Pass in user generated arguments
                mysqli_stmt_execute($stmtInsertArticle); //execute
                $result = mysqli_stmt_get_result($stmtInsertArticle);

                header("Location: ../article_create.php?signup=success");
                    
                exit();
            }

        }
        mysqli_stmt_close($stmtInsertArticle);
        mysqli_close($conn);

    }