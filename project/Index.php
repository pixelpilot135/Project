<?php
session_start();
require_once 'Medewerker.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Ter Duin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./styles/nav.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light">
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

<div class="header">
    <h1 class="header-color">Welkom bij Hotel Ter Duin</h1>
    <p class="color-text" >Geniet van een comfortabele en rustige vakantie aan de kust</p>
    <a href="reservering.php" class="btn">Reserveer Nu</a>
</div>

<div class="container">
    <h2 class="colormain-text my-4">Over Hotel Ter Duin</h2>
    <p class="color-text">Hotel Ter Duin is een charmant hotel gelegen in een prachtig duingebied. Onze kamers zijn comfortabel en volledig uitgerust om een ontspannen verblijf te garanderen. Of je nu komt voor een romantisch uitje, een gezinsvakantie of een zakelijke reis, wij bieden de perfecte omgeving voor een aangenaam verblijf.</p>

    <h3 class="colormain-text">Faciliteiten</h3>
    <ul class="color-text" >
        <li>Gratis Wi-Fi in het hele hotel</li>
        <li>Zwembad en wellnesscentrum</li>
        <li>Restaurant met lokale gerechten</li>
        <li>Vergaderzalen voor zakelijke evenementen</li>
        <li>Gratis parkeergelegenheid</li>
        <li>Fietsverhuur en wandelroutes in de duinen</li>
    </ul>
</div>

<div class="container features">
    <h2 class="colormain-text my-4">Onze Kamers</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="./img/kamer1.jpg" class="card-img-top" alt="Standaard Kamer">
                <div class="card-body">
                    <h5 class="color-text card-title">Standaard Kamer</h5>
                    <p class="card-text">Comfortabele kamer met alle normale faciliteiten voor een ontspannend verblijf.</p>
                    <a href="reservering.php" class="btn">Reserveer Nu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="./img/kamer2.jpg" class="card-img-top" alt="luxe Kamer">
                <div class="card-body">
                    <h5 class="color-text card-title">luxe Kamer</h5>
                    <p class="card-text">Ruime kamer met extra luxe faciliteiten en uitzicht op de duinen.</p>
                    <a href="reservering.php" class="btn">Reserveer Nu</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="./img/kamer3.jpg" class="card-img-top" alt="Suite">
                <div class="card-body">
                    <h5 class="color-text card-title">Suite</h5>
                    <p class="card-text">Luxe suite met aparte woon- en slaapruimtes en een privéterras.</p>
                    <a href="reservering.php" class="btn">Reserveer Nu</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>&copy; 2025 Hotel Ter Duin. Alle rechten voorbehouden.</p>
</div>

</body>
</html>
