<?php
    declare(strict_types = 1);
    require "header.php"
?>

<?php
    if (isset($_SESSION['user_id'])) {
        echo '<div id="upload-form">
                <h2>Upload Profile Picture</h2>

                <form id="profile-upload-form" action="includes/profile_upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file-data">
                    <button type="submit" name="submit">Upload</button>
                </form>
            ';

        $userId = $_SESSION['user_id'];
        $sqlImage = "SELECT * FROM profile_image WHERE user_id='$userId'";
        $resultImage = mysqli_query($conn, $sqlImage);

        while ($rowImage = mysqli_fetch_assoc($resultImage)) {
            echo"<div class='user-item'>";
                if ($rowImage['status'] === '1') {
                    $filename = "uploads/profile_" . $userId . ".*"; //check for any extension
                    $fileInfo = glob($filename); //grab all results (there should only be 1)
                    $filePath = $fileInfo[0];

                    echo "<img class='user-avatar' src='$filePath'>
                                    <form id='profile-delete-form' action='includes/profile_delete.php' method='POST' enctype='multipart/form-data'>
                            <button type='submit' name='submit'>Remove</button>
                        </form>";
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