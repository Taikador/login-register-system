<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <div class="errors">
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo "<div id='warning_input'>Fill in all fields!</div>";
            } else if ($_GET['error'] == "wronglogin1") {
                echo "<div id='error_pwd'>Your username or password were wrong!</div>";
            } else if ($_GET['error'] == "wronglogin2") {
                echo "<div id='error_wpwd'>Your username or password were wrong!</div>";
            }
        }
        ?>
    </div>
    <div class="center">
        <section class="input__form">
            <h1>Log In</h1>
            <form action="../login-register-system/inc/login.inc.php" method="POST">
                <div class="text__field">
                    <input type="text" name="username" required>
                    <span></span>
                    <label>Username/Email</label>
                </div>
                <div class="text__field">
                    <input type="password" name="pwd" required>
                    <span></span>
                    <label>Password</label>
                </div>
                <input type="submit" class="btn" name="submit" value="Login">
                <div class="signup__link">
                    Not a member ? <a href="./signup.php">Signup</a>
                </div>
            </form>

        </section>
    </div>
</body>

</html>