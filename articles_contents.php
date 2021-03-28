<?php
    if (isset($_SESSION['user_id'])) {
        // echo '<a  href="./article_create.php">Create Article</a>';
        echo '
            <form class="article-create" action="./article_create.php">
                <button type="submit">Create Article</button>
            </form>
            ';
        }
?>


<div class="articles-wrapper">
    <?php
        function getUserName($conn, $userId) {
            $sql = "SELECT user_name
                FROM users 
                WHERE user_id = '$userId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            
            return $row['user_name'];
        }

        $sql = 'SELECT * FROM article
            ORDER BY article_id DESC';
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

        if ($queryResults) {
            while ($row = mysqli_fetch_assoc($result)) {
                $author = getUserName($conn, $row['article_author']);

                echo '<div class="article-wrapper item">
                        <a href="article.php?id=' . $row['article_id'] .
                            '&title=' . $row['article_title'] .
                        '">
                            <h3 class="article-title">' . $row['article_title'] . '</h3>
                        </a>
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
