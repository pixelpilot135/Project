<?php
require_once "../hotelterduin/includes/Dashboard1.php";
require_once 'Medewerker.php';
session_start();

$medewerker = new Medewerker();
if (!$medewerker->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$dashboard = new Dashboard();
$availableRooms = $dashboard->getAvailableRooms();
$reservaties = $dashboard->getReservations();
$dashboard->storeAlarm($availableRooms);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medewerker Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reservering.php">Reserveren</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php if (isset($_SESSION['medewerker_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Uitloggen</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <h1 class="my-4">Resevering Dashboard</h1>

    <?php if ($availableRooms <= 2) { ?>
        <div class="alert alert-warning" role="alert">
            Er zijn nog maar <?php echo $availableRooms; ?> kamers beschikbaar!
        </div>
    <?php } ?>

    <h3>Reserveringen</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Klantnaam</th>
                <th>Kamer</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservaties as $index => $reservering) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $reservering['Naam'] ?></td>
                    <td><?= $reservering['Kamernummer'] ?> (<?= $reservering['Type'] ?>)</td>
                    <td><?= $reservering['CheckInDatum'] ?></td>
                    <td><?= $reservering['CheckOutDatum'] ?></td>
                    <td><?= $reservering['Status'] ?></td>
                    <td>
                        <?php if ($reservering['Status'] == 'in behandeling') { ?>
                            <form method="POST" action="accepteer.php">
                                <input type="hidden" name="reservering_id" value="<?= $reservering['ReserveringID'] ?>">
                                <button type="submit" class="btn btn-success btn-sm">Accepteer</button>
                            </form>
                        <?php } ?>
                        <a href="wijzig_reservering.php?id=<?= $reservering['ReserveringID']?>"class="btn btn-warning btn-sm">Wijzigen</a>
                        <a href="verwijder_reservering.php?id=<?= $reservering['ReserveringID']?>"class="btn btn-danger btn-sm">Verwijderen</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Verhuurde Kamers</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Kamer Nummer</th>
                <th>Type</th>
                <th>Naam Klant</th>
                <th>Check-In Datum</th>
                <th>Check-Out Datum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $verhuurdeKamers = $dashboard->getRentedRooms();
            foreach ($verhuurdeKamers as $kamer) { ?>
                <tr>
                    <td><?= $kamer['Kamernummer'] ?></td>
                    <td><?= $kamer['Type'] ?></td>
                    <td><?= $kamer['KlantNaam'] ?></td>
                    <td><?= $kamer['CheckInDatum'] ?></td>
                    <td><?= $kamer['CheckOutDatum'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <button onclick="window.print()" class="btn btn-primary btn-sm">Print De Gegevens</button>
</div>
</body>
</html>
