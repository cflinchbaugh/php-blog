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
            <!-- <h2>Users</h2>
            <?php
                // $sql = "SELECT * FROM users";
                // $result = mysqli_query($conn, $sql);
                // if (mysqli_num_rows($result) > 0) { //if there are results
                //     echo "<div id='users-list'>";
                //     while ($row = mysqli_fetch_assoc($result)) { //loop over each row
                //         $id = $row['user_id'];
                //         $sqlImage = "SELECT * FROM profile_image WHERE user_id='$id'";
                //         $resultImage = mysqli_query($conn, $sqlImage);

                //         while ($rowImage = mysqli_fetch_assoc($resultImage)) {
                //             echo"<div class='user-item'>";
                //                 if ($rowImage['status'] === '1') {
                //                     echo "<img class='user-avatar' src='uploads/profile_".$id.".jpg'>";
                //                 } else {
                //                     echo "<img class='user-avatar' src='uploads/profile_default.jpg'>";
                //                 }
                //                 echo $row['user_name'];
                //             echo"</div>";
                //         }
                //     }
                //     echo "</div>";
                // } else {
                //     echo "No Users";
                // }
            ?>
            
            <hr/> -->
            
            <?php
                if (isset($_SESSION['user_id'])) {
                    echo '<div id="upload-form">
                            <h2>Upload Profile Picture</h2>';
                            $id = $_SESSION['user_id'];
                            $sqlImage = "SELECT * FROM profile_image WHERE user_id='$id'";
                            $resultImage = mysqli_query($conn, $sqlImage);
            
                            while ($rowImage = mysqli_fetch_assoc($resultImage)) {
                                echo"<div class='user-item'>";
                                    if ($rowImage['status'] === '1') {
                                        echo "<img class='user-avatar' src='uploads/profile_".$id.".jpg'>";
                                    } else {
                                        echo "<img class='user-avatar' src='uploads/profile_default.jpg'>";
                                    }
                                    echo $_SESSION['user_name'];
                                echo"</div>";
                            }

                            '<form id="upload-form" action="includes/upload.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="file-data">
                                <button type="submit" name="submit">Upload</button>
                            </form>
                        </div>';
                } else {
                    echo '<h1>Welcome!</h1>';
                }
            ?>
        </main>

        <?php
            require "footer.php"
        ?>
    </body>
</html>