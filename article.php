<?php
    include 'header.php';
?>

<h1>Article Details</h1>

<div class="articles-wrapper">
    <?php

        function getUserName($conn, $userId) {
            $sql = "SELECT user_name FROM users WHERE
                user_id = '$userId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            
            return $row['user_name'];
        }

        $articleId = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM article WHERE
            article_id='$articleId'";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);      

        if ($queryResults) {
            while ($row = mysqli_fetch_assoc($result)) {
                $author = getUserName($conn, $row['article_author']);

                echo '<div class="article-wrapper item">
                        <h3 class="article-title">' . $row['article_title'] . '</h3>
                        <div class="article-text">' . $row['article_text'] . '</div>
                        <div class="article-info-wrapper">
                            <div class="article-author">' . $author . '</div>
                            <div class="article-separator"> - </div>
                            <div class="article-date">' . $row['article_date'] . '</div>
                        </div>
                    </div>
                ';
            }

        } else {
            echo 'No Articles!';
        }

    ?>
</div>

<?php
    include 'footer.php';
?>
       