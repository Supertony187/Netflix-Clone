<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Streaming-Webseite</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script>
        setTimeout(function () {
            window.location.href = "index.php";
        }, 5000); // Weiterleitung nach 5 Sekunden
    </script>
</head>

<body>
    <script>
        function toggle() {
            const dropdownContent = document.getElementById('dropdown-content');
            if (dropdownContent.classList.contains('show')) {
                dropdownContent.classList.remove('show');
            } else {
                dropdownContent.classList.add('show');
            }
        }
    </script>

    <header>
        <div class="container">
            <div class="logo">
                <img src="https://media.discordapp.net/attachments/1112063829929640088/1113581518208639016/tonyplus.png"
                    alt="Netflix Logo">
            </div>
            <div class="buttons">
                <a class="signinup" href="login.php">Anmelden</a>
                <a class="signinup" href="register.php">Registrieren</a>

                <div class="dropdown">
                    <button class="dropdown-btn" onclick="toggle();">
                        <img src="https://profile-images.xing.com/images/0a688270829fc3ba8cf3309c46332161-13/carl-philipp-trump.1024x1024.jpg"
                            alt="">
                    </button>
                    <div class="dropdown-content" id="dropdown-content">
                        <a href="http://188.68.37.157/streaming/index.php" target="_self">
                            <i class="material-symbols-outlined">
                                home
                            </i>
                            <span>Startseite</span>
                        </a>
                        <a href="#">
                            <i class="material-symbols-outlined">
                                person
                            </i>
                            <span>Profil</span>
                        </a>
                        <a href="http://188.68.37.157/streaming/logout.php" target="_self">
                            <i class="material-symbols-outlined">
                                logout
                            </i>
                            <span>Ausloggen</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <h1>Du hast dich erfolgreich abgemeldet.</h1>
        <h1>Du wirst in 5 Sekunden weitergeleitet.</h1>
    </div>
</body>

</html>
