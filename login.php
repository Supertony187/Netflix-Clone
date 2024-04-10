<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "wsxayed";
$dbName = "movie";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
}

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM benutzer WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            $_SESSION['premium'] = $row['premium']; // Hinzufügen der "premium" Session-Variable
            header("Location: index.php");
            exit();
        } else {
            echo "Falsches Passwort.";
        }
    } else {
        echo "Benutzername nicht gefunden.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 3px;
        }

        .form-group input:focus {
            outline: none;
        }

        .btn {
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

        .btn:hover {
            background-color: #bf080e;
        }

        .error-message {
            color: #ff0000;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://media.discordapp.net/attachments/1112063829929640088/1113581518208639016/tonyplus.png"
                alt="Netflix Logo">
        </div>
        <h1>Login</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Einloggen" class="btn">
            </div>
        </form>
    </div>
</body>
</html>
