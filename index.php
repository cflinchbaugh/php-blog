<?php
    declare(strict_types = 1);
    require "header.php"
?>

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
    } else {
        echo '<h1>Welcome!</h1>';
    }
?> 

<?php
    require "footer.php"
?>