<?php
    include 'header.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./index.php?error=notLoggedIn");
    }
?>

<main>
    <h1>Create Article</h1>

    <?php
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                default:
                    echo "Error";
                    break;
            }
        } else if (isset($_GET['error']) && $_GET['signup'] === 'success') {
            echo "Article Created!";
        }
    ?> 

    <form action="includes/article_create.php" method="post">
        <?php
            $title = isset($_GET['title']) ? $_GET['title'] : "";

            echo '<input type="text" name="title" placeholder="Title" value="'.$title.'">';
        ?> 

        <?php
            $message = isset($_GET['message']) ? $_GET['message'] : "";

            echo '<textarea type="text" name="message" placeholder="Message">'.$message.'</textarea>';
        ?> 

        <button type="submit" name="article-create-submit">Post</button>
    </form>
</main>

<?php
    require "footer.php"
?>
