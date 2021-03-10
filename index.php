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
            
            
            <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<br/><br/><br/>';
                    echo '<form action="upload.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="file-data">
                            <button type="submit" name="submit">Upload</button>
                        </form>';
                } else {
                    echo '<h1>Login</h1>';
                    echo '<p>You are logged out</p>';
                }
            ?>
        </main>

        <?php
            require "footer.php"
        ?>
    </body>
</html>