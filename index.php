<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = $_SESSION['username'];
    $isPremium = $_SESSION['premium'];
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Streaming-Webseite</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
                <?php if ($username !== "Gast") { ?>
                    <a class="signinup" href="#">Profil</a>
                    <a class="signinup" href="logout.php">Abmelden</a>
                <?php } else { ?>
                    <a class="signinup" href="login.php">Anmelden</a>
                    <a class="signinup" href="register.php">Registrieren</a>
                <?php } ?>

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
                        <a href="http://188.68.37.157/streaming/profil.php" target="_self">
                            <i class="material-symbols-outlined">
                                person
                            </i>
                            <span>Profil</span>
                        </a>
                        <a href="logout.php">
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
        <?php if ($isPremium === 1) { ?>
            <h1>Willkommen auf der Streaming-Webseite</h1>
            <h2>Filme</h2>
            <ul class="film-list">
                <?php
                $dbHost = "localhost";
                $dbUser = "root";
                $dbPass = "rentneralarm";
                $dbName = "movie";

                $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

                if (!$conn) {
                    die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM filme";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $filmTitle = $row['title'];
                    $filmImage = $row['image'];
                    $filmStreamingLink = $row['streaming_link'];

                    echo '<li>
                    <a href="film.php?film_id=' . $row['id'] . '" target="_blank">
                        <img src="' . $filmImage . '" alt="' . $filmTitle . '">
                        <span>' . $filmTitle . '</span>
                    </a>
                </li>';
                }

                mysqli_close($conn);
                ?>
            </ul>
        <?php } else { ?>
            <h1>Du hast kein Premium</h1>
            <p>Um auf die Webseite zuzugreifen, benötigst du ein Premium-Konto.</p>
        <?php } ?>
    </div>
</body>

</html>
