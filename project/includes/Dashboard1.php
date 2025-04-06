<?php
require_once "../hotelterduin/includes/db.php";

class Dashboard {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getAvailableRooms() {
        $stmt = $this->db->query("SELECT COUNT(*) AS totaal_kamers FROM Kamer");
        $totalRooms = $stmt->fetch(PDO::FETCH_ASSOC)['totaal_kamers'];

        $stmt = $this->db->query("SELECT COUNT(*) AS bezette_kamers
            FROM Reservering
            WHERE CheckInDatum <= CURDATE() AND CheckOutDatum >= CURDATE()");
        $occupiedRooms = $stmt->fetch(PDO::FETCH_ASSOC)['bezette_kamers'];

        return $totalRooms - $occupiedRooms;
    }

    public function getReservations() {
        $stmt = $this->db->query("SELECT Reservering.*, Klant.Naam, Kamer.Kamernummer, Kamer.Type
            FROM Reservering
            JOIN Klant ON Reservering.KlantID = Klant.KlantID
            JOIN Kamer ON Reservering.KamerID = Kamer.KamerID");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRentedRooms() {
        $stmt = $this->db->query("SELECT Kamer.Kamernummer, Kamer.Type, Klant.Naam AS KlantNaam, Reservering.CheckInDatum, Reservering.CheckOutDatum
            FROM Reservering
            JOIN Kamer ON Reservering.KamerID = Kamer.KamerID
            JOIN Klant ON Reservering.KlantID = Klant.KlantID
            WHERE Reservering.CheckInDatum <= CURDATE()
            AND Reservering.CheckOutDatum >= CURDATE()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function storeAlarm($availableRooms) {
        if ($availableRooms <= 2) {
            $stmt = $this->db->prepare("INSERT INTO Alarm (Datum, AantalKamersVrij) VALUES (CURDATE(), :aantalKamersVrij)");
            $stmt->bindParam(':aantalKamersVrij', $availableRooms);
            $stmt->execute();
        }
    }

    public function acceptReservation($reserveringID) {
        $stmt = $this->db->prepare("UPDATE Reservering SET Status = 'bevestigd' WHERE ReserveringID = :reserveringID");
        $stmt->bindParam(':reserveringID', $reserveringID);
        $stmt->execute();

        $stmt = $this->db->prepare("UPDATE Kamer SET Verhuurd = 1 WHERE KamerID = (SELECT KamerID FROM Reservering WHERE ReserveringID = :reserveringID)");
        $stmt->bindParam(':reserveringID', $reserveringID);
        $stmt->execute();
    }
}
?>
