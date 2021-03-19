<?php
    include 'header.php';
?>

<h1>Search</h1>

<div class="articles-wrapper">
    <?php
        if (isset($_POST['search-submit'])) {
            $escapedSearchString = mysqli_real_escape_string($conn, $_POST['search-value']);
            $sql = "SELECT * FROM article WHERE 
                article_title LIKE '%$escapedSearchString%' OR
                article_text LIKE '%$escapedSearchString%' OR
                article_author LIKE '%$escapedSearchString%' OR
                article_date LIKE '%$escapedSearchString%'
            ";

            $result = mysqli_query($conn, $sql);

            $queryResultCount = mysqli_num_rows($result);

            echo "Total Results: " . $queryResultCount;

            if ($queryResultCount) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <div class="article-wrapper">
                            <a href="article.php?title=' . $row['article_title'] . '&date=' . $row['article_date'] .'">  
                                <h3>' . $row['article_title'] . '</h3>
                            </a>
                            <div class="article_text">' . $row['article_text'] . '</div>
                            <div class="article-info-wrapper">
                                <div class="article_author">' . $row['article_author'] . '</div>
                                <div class="article-separator"> - </div>
                                <div class="article_date">' . $row['article_date'] . '</div>
                            </div>
                        </div>
                    ';
                }
            }

        } else {
            header('Location: index.php?error=noSubmit');
        }
    ?>
</div>