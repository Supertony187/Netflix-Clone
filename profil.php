<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = $_SESSION['username'];
} else {
    $username = "Gast";
}

// Datenbankverbindung herstellen
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "wsxayed";
$dbName = "movie";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
}

// Filme in der Watchlist abrufen
$query = "SELECT film_id FROM watchlist WHERE username = '$username' AND added = true";
$result = mysqli_query($conn, $query);

$watchlistFilms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $watchlistFilms[] = $row['film_id'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Watchlist</title>
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
                        <a href="#">
                            <i class="material-symbols-outlined">
                                person
                            </i>
                            <span>Profil</span>
                        </a>
                        <a href="#">
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
    <div class="banner">
    <img src="https://cdn.discordapp.com/attachments/1112063829929640088/1113755296603578469/snapedit_1685609970661.jpg" alt="Banner">
 
</div>

    <div class="container">
    <h1>Watchlist</h1>
    <div class="film-list">
        <?php
        foreach ($watchlistFilms as $film) {
            $query = "SELECT * FROM filme WHERE id = $film";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $filmTitle = $row['title'];
            $filmImage = $row['image'];
            $filmStreamingLink = $row['streaming_link'];
        ?>
            <div class="film">
                <a href="<?php echo $filmStreamingLink; ?>" target="_blank">
                    <img class="film-image" src="<?php echo $filmImage; ?>" alt="<?php echo $filmTitle; ?>">
                    <span class="film-title"><?php echo $filmTitle; ?></span>
                </a>
            </div>
        <?php } ?>
    </div>

    <h2>Abonniert</h2>
    <div class="film-list">
        <?php
        // Abonnierte Filme abrufen
        $abonnementQuery = "SELECT film_id FROM abonnements WHERE username = '$username'";
        $abonnementResult = mysqli_query($conn, $abonnementQuery);

        $abonnementFilms = [];
        while ($abonnementRow = mysqli_fetch_assoc($abonnementResult)) {
            $abonnementFilms[] = $abonnementRow['film_id'];
        }

        foreach ($abonnementFilms as $film) {
            $query = "SELECT * FROM filme WHERE id = $film";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $filmTitle = $row['title'];
            $filmImage = $row['image'];
            $filmStreamingLink = $row['streaming_link'];
        ?>
            <div class="film">
                <a href="<?php echo $filmStreamingLink; ?>" target="_blank">
                    <img class="film-image" src="<?php echo $filmImage; ?>" alt="<?php echo $filmTitle; ?>">
                    <span class="film-title"><?php echo $filmTitle; ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

</body>

</html>

<?php
// Verbindung zur Datenbank schließen
mysqli_close($conn);
?>
