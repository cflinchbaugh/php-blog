
<?php
    require "header.php"
?>

<main>
    <h1>Signup</h1>

    <form action="includes/signup.php" method="post">
        <?php
            $username = isset($_GET['username']) ? $_GET['username'] : "";

            echo '<input type="text" name="user-name" placeholder="Username" value="'.$username.'">';
        ?> 

        <?php
            $email = isset($_GET['email']) ? $_GET['email'] : "";

            echo '<input type="text" name="user-email" placeholder="Email" value="'.$email.'">';
        ?> 
        
        <input type="password" name="user-password" placeholder="Password">
        <input type="password" name="user-password-repeat" placeholder="Repeat Password">

        <button type="submit" name="signup-submit">Signup</button>
    </form>
</main>

<?php
    require "footer.php"
?>
