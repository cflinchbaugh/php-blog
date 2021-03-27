
<?php
    include_once 'includes/dbh.php';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Procedural login demo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" href="styles/header.css">
        <link rel="stylesheet" href="styles/pages/home.css">
        <link rel="stylesheet" href="styles/pages/article.css">
        <link rel="stylesheet" href="styles/pages/article-create.css">
        <link rel="stylesheet" href="styles/items/common.css">
        <link rel="stylesheet" href="styles/items/gallery.css">
        <link rel="stylesheet" href="styles/items/user.css">
    </head>

    <header>
        <nav>
            <div class="header-contents">
                <?php 
                    if (isset($_SESSION['user_id'])) {
                        echo '
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="articles.php">Articles</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a href="users.php">Users</a></li>
                            </ul>

                            <form action="search.php" method="POST">
                                <input type="text" name="search-value" placeholder="Search Articles">
                                <button type="submit" name="search-submit">Search</button>
                            </form>

                            <form action="includes/logout.php" method="post">
                                <button class="logout-submit" type="submit" name="logout-submit">Logout ' . $_SESSION['user_name'] . '</button>
                            </form>
                        ';
                    } else {
                        echo '
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="articles.php">Articles</a></li>
                            </ul>

                            <form action="includes/login.php" method="post">
                                <input class="login-input login-text" type="text" name="user-name" placeholder="Username">
                                <input class="login-input login-password" type="password" name="user-password" placeholder="Password">
                                <button class="login-submit" type="submit" name="login-submit">Login</button>
                            </form>

                            <form action="signup.php" method="post">
                                <button class="signup-submit" type="submit" name="signup-button">Signup</button>
                            </form>
                        ';
                    }
                ?>
            </div>
        </nav>
    </header>

    <body>
        <main>