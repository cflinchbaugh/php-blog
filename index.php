<?php
    declare(strict_types = 1);
    include 'includes/class-autoloader.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Procedural login demo">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>

    <body>
        <?php
            require "header.php"
        ?>

        <main>
            <h1>Login</h1>
            
            <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<p>You are logged in</p>';
                } else {
                    echo '<p>You are logged out</p>';
                }
            ?>
        </main>

        <?php
            require "footer.php"
        ?>
    </body>
</html>