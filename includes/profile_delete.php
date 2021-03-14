<?php
    require "../header.php";
    $userId = $_SESSION['user_id'];

    if (isset($_POST['submit']) && $userId) {
        $filename = "../uploads/profile_" . $userId . ".*"; //check for any extension
        $fileInfo = glob($filename); //grab all results (there should only be 1)
        $filePath = $fileInfo[0];

        if (!unlink($filePath)) {
            echo "Error: File was not deleted";
        } else {
            echo "Success: File was deleted";

            $sql = "UPDATE profile_image SET status=0 WHERE user_id='$userId';";
            mysqli_query($conn, $sql);

            header("Location: ../index.php?success=profileDeleted");
        }
    } else {
        header('Location: ../index.php?error=noSubmission');
    }