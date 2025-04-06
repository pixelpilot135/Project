<?php
require_once "../hotelterduin/includes/db.php";
require_once "../hotelterduin/includes/Reservering1.php";
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Ongeldige reservering.");
}

$reserveringID = $_GET['id'];
$reservering = new Reservering();
$db = (new Database())->getConnection();
$melding = "";

$stmt = $db->prepare("SELECT * FROM Reservering WHERE ReserveringID = :reserveringID");
$stmt->bindParam(':reserveringID', $reserveringID);
$stmt->execute();
$reserveringData = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reserveringData) {
    die("Reservering niet gevonden.");
}

$kamers = $reservering->getAvailableRooms();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kamerID = $_POST['kamerID'] ?? null;
    $checkIn = $_POST['checkInDatum'] ?? null;
    $checkOut = $_POST['checkOutDatum'] ?? null;

    if ($kamerID && $checkIn && $checkOut) {
        $stmt = $db->prepare("UPDATE Reservering SET KamerID = :kamerID, CheckInDatum = :checkIn, CheckOutDatum = :checkOut WHERE ReserveringID = :reserveringID");
        $stmt->bindParam(':kamerID', $kamerID);
        $stmt->bindParam(':checkIn', $checkIn);
        $stmt->bindParam(':checkOut', $checkOut);
        $stmt->bindParam(':reserveringID', $reserveringID);

        if ($stmt->execute()) {
            $melding = "<div class='alert alert-success'>Reservering succesvol bijgewerkt!</div>";
        } else {
            $melding = "<div class='alert alert-danger'>Fout bij het bijwerken van de reservering.</div>";
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
    <title>Reservering Wijzigen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <h2 class="my-4">Reservering Wijzigen</h2>
    <?= $melding ?>
    <form method="POST">
        <div class="mb-3">
            <label for="kamerID" class="form-label">Kies een nieuwe kamer:</label>
            <select class="form-control" name="kamerID" required>
                <?php foreach ($kamers as $kamer) { ?>
                    <option value="<?= $kamer['KamerID'] ?>" <?= ($kamer['KamerID'] == $reserveringData['KamerID']) ? 'selected' : '' ?>>
                        Kamer <?= $kamer['Kamernummer'] ?> - €<?= $kamer['Prijs'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="checkInDatum" class="form-label">Check-in Datum:</label>
            <input type="date" class="form-control" name="checkInDatum" value="<?= $reserveringData['CheckInDatum'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="checkOutDatum" class="form-label">Check-out Datum:</label>
            <input type="date" class="form-control" name="checkOutDatum" value="<?= $reserveringData['CheckOutDatum'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Wijzig Reservering</button>
        <a href="dashboard.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
</body>
</html>