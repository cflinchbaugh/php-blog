
<?php
    require "header.php"
?>

<main>
    <h1>Signup</h1>

    <?php
        if (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'emptyfields':
                    echo "Error: Please fill in all fields";
                    break;
                case "invalidUsername":
                    echo "Error: Invalid Username";
                    break;
                case "invalidEmail":
                    echo "Error: Invalid Email";
                    break;
                case "passwordRepeat":
                    echo "Error: Passwords do not match";
                    break;
                case "usernameTaken":
                    echo "Error: Username taken";
                    break;
                default:
                    echo "Error";
                    break;
            }
        } else if (isset($_GET['error']) && $_GET['signup'] === 'success') {
            echo "Signup success!";
        }
    ?> 

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
