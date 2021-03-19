
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
        <link rel="stylesheet" href="styles.css">
    </head>

    <header>
        <nav>
            <!-- <div class="logo-wrapper">
                <a href="../index.php">LOGO</a>
            </div> -->

            <div class="header-contents">
                <?php 
                    if (isset($_SESSION['user_id'])) {
                        echo '
                        
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="articles.php">Articles</a></li>
                                <li><a href="users.php">Users</a></li>
                            </ul>

                            <form action="search.php" method="POST">
                                <input type="text" name="search-value" placeholder="Search Articles">
                                <button type="submit" name="search-submit">Search</button>
                            </form>

                            <form action="includes/logout.php" method="post">
                                <button type="submit" name="logout-submit">Logout ' . $_SESSION['user_name'] . '</button>
                            </form>
                        ';
                    } else {
                        echo '
                            <form action="includes/login.php" method="post">
                                <input type="text" name="user-name" placeholder="Username">
                                <input type="password" name="user-password" placeholder="Password">
                                <button type="submit" name="login-submit">Login</button>
                            </form>

                            <a href="signup.php">Signup</a>
                        ';
                    }
                ?>
            </div>
        </nav>
    </header>

    <body>
        <main>