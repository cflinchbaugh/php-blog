<?php
    declare(strict_types = 1);
    include 'includes/class-autoloader.php';
    include_once 'includes/dbh.php';
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
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) { //if there are results
                    while ($row = mysqli_fetch_assoc($result)) { //loop over each row
                        $id = $row['user_id'];
                        $sqlImage = "SELECT * FROM profile_image WHERE user_id='$id'";
                        $resultImage = mysqli_query($conn, $sqlImage);

                        while ($rowImage = mysqli_fetch_assoc($resultImage)) {
                            echo"<div>";
                                if ($rowImage['status'] === '1') {
                                    echo "<img src='uploads/profile_".$id.".jpg'>";
                                } else {
                                    echo "<img src='uploads/profile_default.jpg'>";
                                }
                                echo $row['user_name'];
                            echo"</div>";
                        }
                    }
                } else {
                    echo "No Users";
                }
            ?>
            
            
            <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<p>Upload File to Server Folder';
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