<!DOCTYPE html>
<html>
<head>
    <title>Netflix - Register</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url("https://help.nflxext.com/396a2a39-8d34-4260-b07a-6391fe04ded5_what_is_netflix_2_en.png");
            background-size: cover;
            background-position: center;
        }

        .container {
            width: 400px;
            height: 400px;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo img {
            width: 150px;
            height: auto;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 3px;
        }

        button[type="submit"] {
            display: inline-block;
            padding: 10px 30px;
            background-color: #e50914;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #bf080e;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "wsxayed";
        $dbName = "movie";

        $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

        if (!$conn) {
            die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
        }

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = "INSERT INTO benutzer (username, email, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($conn, $query)) {
            echo "<div class='container'>";
            echo "<h1>Registrierung erfolgreich!</h1>";
            echo "<p>Du hast dich erfolgreich registriert.</p>";
            echo "</div>";
            header("Location: index.php"); // Weiterleitung zur index.php
            exit;
        } else {
            echo "<div class='container'>";
            echo "<h1>Fehler bei der Registrierung</h1>";
            echo "<p>Es ist ein Fehler bei der Registrierung aufgetreten. Bitte versuche es erneut.</p>"
            echo "</div>";
        }

        mysqli_close($conn);
    } else {
    ?>
    <div class="container">
        <div class="logo">
            <img src="https://media.discordapp.net/attachments/1112063829929640088/1113581518208639016/tonyplus.png"
                alt="Netflix Logo">
        </div>
        <h1>Registrieren</h1>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Benutzername" required>
            <input type="email" name="email" placeholder="E-Mail-Adresse" required>
            <input type="password" name="password" placeholder="Passwort" required>
            <button type="submit">Registrieren</button>
        </form>
    </div>
    <?php
    }
    ?>
</body>
</html>
