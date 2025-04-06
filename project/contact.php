<?php
require_once 'Medewerker.php';
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Hotel Ter Duin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/contact.css">
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

<div class="container mt-5">
    <h1 class="colormain-text text-center mb-4">Neem Contact met Ons op</h1>
    <p class="color-text text-center mb-4">Heb je vragen? Vul het formulier hieronder in, en wij zullen je zo snel mogelijk beantwoorden.</p>

    <form>
        <div class="mb-3">
            <label for="naam" class="form-label">Je naam</label>
            <input type="text" class="form-control" id="naam" name="naam" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Je e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="bericht" class="form-label">Je bericht</label>
            <textarea class="form-control" id="bericht" name="bericht" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-lg w-100">Verstuur</button>
    </form>

    <div class="info mt-4 p-4 rounded">
        <h3 class="text-white">Adresgegevens:</h3>
        <p class="text-white">Hotel Ter Duin</p>
        <p class="text-white">Adres: Straatnaam 123, 1234 AB Stad</p>
        <p class="text-white">Email: info@hotelterduin.nl</p>
        <p class="text-white">Telefoon: +31 123 456 789</p>
    </div>
</div>

</body>
</html>
