
<?php
    session_start();
?>

<head>
    <meta charset="utf-8">
    <meta name="description" content="Procedural login demo">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="styles.css">
</head>

<header>
    <nav>
        <a href="#">LOGO</a>

        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <div>
            <form action="includes/login.php" method="post">
                <input type="text" name="user-name" placeholder="Username">
                <input type="password" name="user-password" placeholder="Password">
                <button type="submit" name="login-submit">Login</button>
            </form>

            <a href="signup.php">Signup</a>
            
            <form action="includes/logout.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>
        </div>
    </nav>
</header>