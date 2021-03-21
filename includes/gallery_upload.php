<?php
    require "../header.php";

    if (!isset($_POST['gallery-upload-submit'])) {
        header("Location: ../gallery.php?error=NoSubmit");
        exit();
    } else {
        function getRowCount($conn) {
            $sql = "SELECT * FROM gallery;";
            $stmt = mysqli_stmt_init($conn);
            $rowCount = 0;

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../gallery.php?error=uploadSqlStmt");
                exit();
            } else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $rowCount = mysqli_num_rows($result);
            }

            return $rowCount;
        }

        function insertGalleryImage($conn,
            $fileId,
            $fileTitle,
            $fileDescription,
            $imageOrder,
            $imageFullName 
        ) {
            $sql = "INSERT INTO gallery (
                image_id,
                image_title,
                image_description,
                image_order,
                image_fullname
            ) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=insertSqlStmt");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sssss", 
                    $fileId,
                    $fileTitle,
                    $fileDescription,
                    $imageOrder,
                    $imageFullName
                );
                mysqli_stmt_execute($stmt);
            }
        }

        function validateExtension($fileExtension){
            $allowedExtensions = array('jpg', 'jpeg', 'png');
            $isValid = false;

            if (in_array($fileExtension, $allowedExtensions)) {
                $isValid = true;
            } else {
                header("Location: ../gallery.php?error=InvalidExtension" . $fileExtension);
                exit();
            }

            return $isValid;
        }

        $fileName = "";
        if (!empty($_POST['fileName'])) {
            $fileName = strtolower(str_replace(" ", "-", $_POST['fileName']));
        } else {
            header("Location: ../gallery.php?error=InvalidFileName");
            exit();
        }

        $newFileName = $fileName;
        $fileTitle = $_POST['fileTitle'];
        $fileDescription = $_POST['fileDescription'];
        $file = $_FILES['file'];

        $fileType = $file['type'];
        $fileTempName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $tempFileExtension = explode(".", $fileName);
        $fileExtension = strtolower(end($tempFileExtension));
        $maxFileSizeKb = 2000000;
        $validExtension = validateExtension($fileExtension);

        if ($validExtension) {
            if ($fileError === 0) {
                if ($fileSize < $maxFileSizeKb ) {
                    if (empty($fileTitle) || empty($fileDescription)) {
                        header("Location: ../gallery.php?error=uploadEmpty");
                        exit();
                    } else {
                        $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileExtension;
                        $fileDestination = "../gallery/" . $imageFullName;
                        $fileId = uniqid("galler", true);
                        $totalResults = getRowCount($conn);
                        $imageOrder = $totalResults + 1;

                        insertGalleryImage($conn, 
                            $fileId,
                            $fileTitle,
                            $fileDescription,
                            $imageOrder,
                            $imageFullName
                        );

                        move_uploaded_file($fileTempName, $fileDestination);

                        header("Location: ../gallery.php?upload=success");
                    }
                } else {
                    echo "File size exceeds max";
                }
            } else {
                header("Location: ../gallery.php?error=fileError");
                exit();
            }
        }
    }