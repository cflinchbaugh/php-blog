<?php
    include 'header.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: ./index.php?error=notLoggedIn");
    }
?>

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

        echo '
            <div class="create-article-title-wrapper">
                <input type="text"
                    name="title" 
                    placeholder="Title" 
                    value="'.$title.'">
            </div>    
            ';
    ?> 

    <?php
        $message = isset($_GET['message']) ? $_GET['message'] : "";

        echo '
            <div class="create-article-message-wrapper">
                <textarea type="text" 
                    name="message" 
                    placeholder="Message">'
                    .$message.
                '</textarea>
            </div>
            ';
    ?> 

    <button type="submit" 
        name="article-create-submit">
        Post
    </button>
</form>

<?php
    require "footer.php"
?>
