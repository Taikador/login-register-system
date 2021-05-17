<?php
session_start();
include_once 'inc/db.inc.php';
include_once 'inc/functions.inc.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/2deba413ff.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <title>Hauptseite</title>
</head>

<body>
    <div class="header">
        <?php

        if (isset($_SESSION['role'])) {
            echo "<div class='logout'><button class='logout__btn'><a href='inc/logout.inc.php'>Logout</a></button></div>";
            if (strcasecmp($_SESSION['role'], "admin") == 0) {

                /* Title */
                echo "<div class='h1'>";
                echo "<h1>Admin Panel</h1>";
                echo "</div>";

                echo "<div class='allboxes'>";

                /* Left box in admin panel */
                echo "<div class='boxleft'>";
                echo "<div class='boxtitle'>";
                echo "<p>Benutzer löschen</p><i class='fas fa-user-slash'></i>";
                echo "</div>";

                /* Left box content in admin panel */
                echo "<div class='boxleft_content'>";
                echo "<p>Klicke unten, um zu dem Formular zu gelangen, wo du Benutzer löschen kannst.</p>";
                echo "</div>";

                /* Left box content in admin panel */
                echo "<div class='boxleft_attention'>";
                echo "<p>Achtung! Gelöschte Benutzer können selbst vom Admin nicht wiederhergestellt werden.</p>";
                echo "</div>";

                /* Little box inside left box */
                echo "<div class='littlebox'>";
                echo "<a href='./admin/delete.php'>";
                echo "<div class='littlebox_text'>";
                echo "<p>Zum Formular ≫</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
                echo "</div>";

                /* Middle box - User edit symbol */
                echo "<div class='boxmiddle'>";
                echo "<div class='boxtitle'>";
                echo "<p>Benutzer bearbeiten</p><i class='fas fa-user-edit'></i>";
                echo "</div>";

                /* Middle box content in admin panel */
                echo "<div class='boxleft_content'>";
                echo "<p>Klicke unten, um zu dem Formular zu gelangen, wo du Benutzer bearbeiten kannst.</p>";
                echo "</div>";


                /* Little box content in admin panel */
                echo "<div class='littlebox'>";
                echo "<a href='./admin/update.php'>";
                echo "<div class='littlebox_text'>";
                echo "<p>Zum Formular ≫</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
                echo "</div>";


                /* Right box in admin panel */
                echo "<div class='boxright'>";
                echo "<div class='boxtitle'>";
                echo "<p>Benutzer suchen</p><i class='fas fa-search'></i>";
                echo "</div>";

                /* Right box content in admin panel */
                echo "<div class='boxleft_content'>";
                echo "<p>Klicke unten, um zu dem Formular zu gelangen, wo du Benutzer suchen kannst.</p>";
                echo "</div>";

                /* Little box inside right box */
                echo "<div class='littlebox'>";
                echo "<a href='./admin/search.php'>";
                echo "<div class='littlebox_text'>";
                echo "<p>Zum Formular ≫</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            } else if (strcasecmp($_SESSION['role'], "trainer") == 0) {

                /* Trainer Panel ? So ähnlich wie das User Panel nur mit Calendar function? */
            } else if (strcasecmp($_SESSION['role'], "user") == 0) {


                $userid = $_SESSION['userid'];
                $username = $_SESSION['username'];

                $sql        = "SELECT * FROM user WHERE user_id = '$userid'";
                $query = $conn->query($sql);

                echo "<h1>User Panel<h1>";
                echo "<br>";
                echo "<h3>Welcome $username !<h3>";
                echo "<br><br>";

                echo "<table class= 'query_table' method='POST' id='query_table'>";
                echo "<thead><tr>";
                echo "<td>Username</td><td>Email</td>";
                echo "</tr></thead>";

                while ($row = $query->fetch_assoc()) {
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
            }
        } else {

            echo "<h1>Login/Register - System<h1>";
            echo "<br><br>";
            echo "<div class='signup'>
                    <button class='signup__btn'><a href='signup.php'>Sign Up</a></button>
                    </div>";
            echo "<div class='login'>
                    <button class='login__btn'><a href='login.php'>Log In</a></button>
                    </div>";
        }

        ?>
</body>

</html>