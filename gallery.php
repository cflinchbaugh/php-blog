<?php
    include 'header.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./index.php?error=notLoggedIn");
    }
?>

<h1>Gallery</h1>

<section>
    <div class="gallery-upload-form">
        <h2>Import Image</h2>
        <form action="includes/gallery_upload.php" method="post" enctype="multipart/form-data">
            <input type="text" name="fileName" placeholder="filename.jpg">
            <input type="text" name="fileTitle" placeholder="Title...">
            <input type="text" name="fileDescription" placeholder="Description...">
            <input type="file" name="file">

            <button type="submit" name="gallery-upload-submit">Upload</button>
        </form>
    </div>
</section>

<section class="gallery-links">
    <div class="gallery-container">
        <?php 
            function getGalleryUploads($conn) {
                $sql = "SELECT * FROM gallery ORDER BY image_order DESC";
                $stmt = mysqli_stmt_init($conn);
                $result = [];

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Fetching Galler Uploads Failed";
                    exit();
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                }

                return $result;
            }

            $result = getGalleryUploads($conn);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <a class="gallery-item item" href="#">
                        <div class="gallery-image" 
                            style="background-image: url(./gallery/'.$row["image_fullname"].');"></div>
                        <div class="image-details">
                            <div class="image-name">'.$row["image_title"].'</div>
                            <div class="image-description">'.$row["image_description"].'</div>
                        </div>
                    </a>
                ';
            }

        ?>
        
    </div>
</section>

<?php
    include 'footer.php';
?>