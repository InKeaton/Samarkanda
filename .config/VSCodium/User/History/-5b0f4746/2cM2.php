<nav>
    <a href="index.php">Index</a> |
    <?php
        if(isset($_SESSION["nome"])) {
            echo("<a href=\"secret.php\">Secret Page</a> |");
        }
        else {
            echo("<a href=\"login.php\">Login</a> |");
            echo("<a href=\"registration.php\">Register</a> |");
        }
    ?>
</nav>