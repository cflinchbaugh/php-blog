
<?php
    require "header.php";
?>

    <h2>Users</h2>
    <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { //if there are results
            echo "<div id='users-list'>";
            while ($row = mysqli_fetch_assoc($result)) { //loop over each row
                $id = $row['user_id'];
                $sqlImage = "SELECT * FROM profile_image WHERE user_id='$id'";
                $resultImage = mysqli_query($conn, $sqlImage);

                while ($rowImage = mysqli_fetch_assoc($resultImage)) {
                    echo"<div class='user-item'>";
                        if ($rowImage['status'] === '1') {
                            echo "<img class='user-avatar' src='uploads/profile_".$id.".jpg'>";
                        } else {
                            echo "<img class='user-avatar' src='uploads/profile_default.jpg'>";
                        }
                        echo $row['user_name'];
                    echo"</div>";
                }
            }
            echo "</div>";
        } else {
            echo "No Users";
        }
    ?>

<?php
    require "footer.php";
?>