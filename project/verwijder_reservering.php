<?php
require_once "../hotelterduin/includes/db.php";

class Reservering {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function deleteReservering($reserveringID) {
        try {
            $stmt = $this->db->prepare("DELETE FROM Reservering WHERE ReserveringID = :reserveringID");
            $stmt->bindParam(':reserveringID', $reserveringID);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

session_start();

if (!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true) {
    header("Location: login.php");
    exit();
}

$reserveringID = $_GET['id'] ?? null;

if ($reserveringID) {
    $reservering = new Reservering();

    if ($reservering->deleteReservering($reserveringID)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $melding = "Er is een fout opgetreden bij het verwijderen van de reservering.";
    }
} else {
    $melding = "Geen reservering gevonden om te verwijderen.";
}
?>

