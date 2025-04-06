<?php
require_once "../hotelterduin/includes/db.php";
require_once "../hotelterduin/includes/Reservering1.php";
session_start();

$reservering = new Reservering();
$kamers = $reservering->getAvailableRooms();
$melding = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = (new Database())->getConnection();

    $naam = $_POST['naam'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefoonnummer = $_POST['telefoonnummer'] ?? null;
    $kamerID = $_POST['kamerID'] ?? null;
    $checkIn = $_POST['checkInDatum'] ?? null;
    $checkOut = $_POST['checkOutDatum'] ?? null;

    if ($naam && $email && $telefoonnummer && $kamerID && $checkIn && $checkOut) {
        $stmt = $db->prepare("SELECT KlantID FROM Klant WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $klant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$klant) {
            $stmt = $db->prepare("INSERT INTO Klant (Naam, Email, Telefoonnummer) VALUES (:naam, :email, :telefoonnummer)");
            $stmt->bindParam(':naam', $naam);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefoonnummer', $telefoonnummer);
            $stmt->execute();
            $klantID = $db->lastInsertId();
        } else {
            $klantID = $klant['KlantID'];
        }

        $_SESSION['klant_id'] = $klantID;

        if ($reservering->maakReservering($klantID, $kamerID, $checkIn, $checkOut)) {
            $melding = "<div class='alert alert-success'>Reservering succesvol!</div>";
        } else {
            $melding = "<div class='alert alert-danger'>Fout bij het maken van de reservering.</div>";
        }
    } else {
        $melding = "<div class='alert alert-warning'>Vul alle velden in.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveer een Kamer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/colors.css">
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
                        <a class="nav-link" href="login.php">Inloggen als medewerker</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="colormain-text my-4">Reserveer een Kamer</h2>
    <?= $melding ?>
    <form method="POST">
        <div class="mb-3">
            <label for="naam" class="form-label">Naam:</label>
            <input type="text" class="form-control" name="naam" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="telefoonnummer" class="form-label">Telefoonnummer:</label>
            <input type="tel" class="form-control" name="telefoonnummer" required>
        </div>

        <div class="mb-3">
            <label for="kamerID" class="form-label">Kies een kamer:</label>
            <select class="form-control" name="kamerID" required>
                <?php foreach ($kamers as $kamer) { ?>
                    <option value="<?= $kamer['KamerID'] ?>">Kamer <?= $kamer['Kamernummer'] ?> - €<?= $kamer['Prijs'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="checkInDatum" class="form-label">Check-in Datum:</label>
            <input type="date" class="form-control" name="checkInDatum" required>
        </div>

        <div class="mb-3">
            <label for="checkOutDatum" class="form-label">Check-out Datum:</label>
            <input type="date" class="form-control" name="checkOutDatum" required>
        </div>

        <button type="submit" class="btn">Reserveren</button>
    </form>
</div>
</body>
</html>
