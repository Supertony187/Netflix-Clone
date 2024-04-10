<?php
session_start();

// Überprüfen, ob der Benutzer angemeldet ist
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = $_SESSION['username'];
} else {
    $username = "Gast";
}

// Überprüfen, ob eine Film-ID übergeben wurde
if (isset($_GET['film_id'])) {
    $filmId = $_GET['film_id'];
} else {
    // Falls keine Film-ID übergeben wurde, Weiterleitung zur Startseite oder Fehlerbehandlung
    header("Location: index.php");
    exit();
}

// Verbindung zur Datenbank herstellen
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "wsxayed";
$dbName = "movie";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
}

// Filminformationen abrufen
$query = "SELECT * FROM filme WHERE id = '$filmId'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $filmTitle = $row['title'];
    $filmImage = $row['image'];
    $filmDescription = $row['description'];

    // Regisseure abrufen
    $queryRegisseure = "SELECT * FROM regisseure WHERE film_id = '$filmId'";
    $resultRegisseure = mysqli_query($conn, $queryRegisseure);
    $regisseure = array();

    while ($rowRegisseur = mysqli_fetch_assoc($resultRegisseure)) {
        $regisseurName = $rowRegisseur['name'];
        $regisseurImage = $rowRegisseur['image'];
        $regisseure[] = array('name' => $regisseurName, 'image' => $regisseurImage);
    }
} else {
    // Falls kein Film mit der übergebenen Film-ID gefunden wurde, Weiterleitung zur Startseite oder Fehlerbehandlung
 //   header("Location: index.php");
   // exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Streaming-Webseite - <?php echo $filmTitle; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
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

    <div class="container">
        <div class="film-details">
            <div class="film-banner">
                <img src="<?php echo $filmImage; ?>" alt="<?php echo $filmTitle; ?>">
            </div>
            <div class="film-description">
                <h2><?php echo $filmTitle; ?></h2>
                <p><?php echo $filmDescription; ?></p>
            </div>
            <div class="regisseure">
                <h2>Regisseure</h2>
                <?php foreach ($regisseure as $regisseur) { ?>
                    <div class="regisseur">
                        <img src="<?php echo $regisseur['image']; ?>" alt="<?php echo $regisseur['name']; ?>">
                        <span><?php echo $regisseur['name']; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>
