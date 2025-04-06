<?php
require_once "../hotelterduin/includes/db.php";
require_once 'Medewerker.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gebruikersnaam = htmlspecialchars($_POST['gebruikersnaam']);
    $wachtwoord = htmlspecialchars($_POST['wachtwoord']);

    $medewerker = new Medewerker();

    if ($medewerker->login($gebruikersnaam, $wachtwoord)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/colors.css">
    <link rel="stylesheet" href="./styles/nav.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php""><img src="./img/logo.jpg" alt="Hotel Ter Duin" style="height: 115px;"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservering.php">Reserveren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php if (isset($_SESSION['medewerker_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Uitloggen</a>
                    </li>
                <?php } ?>
                <?php if (!isset($_SESSION['medewerker_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Inloggen als Medewerker</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="colormain-text my-4">Medewerker Inloggen</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="gebruikersnaam" class="form-label">Gebruikersnaam</label>
            <input type="text" class="form-control" name="gebruikersnaam" required>
        </div>
        <div class="mb-3">
            <label for="wachtwoord" class="form-label">Wachtwoord</label>
            <input type="password" class="form-control" name="wachtwoord" required>
        </div>
        <button type="submit" class="btn">Inloggen</button>
    </form>
</div>

</body>
</html>