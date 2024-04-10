<?php
$hostname = "localhost"; // Hostname der Datenbank
$username = "root"; // Benutzername der Datenbank
$password = "wsxayed"; // Passwort der Datenbank
$database = "movie"; // Name der Datenbank

// Verbindung zur Datenbank herstellen
$link = mysqli_connect($hostname, $username, $password, $database);

// Überprüfen der Verbindung
if (!$link) {
    die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
}
?>
