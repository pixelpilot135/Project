<?php
require_once "../hotelterduin/includes/db.php";

class Reservering {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getAvailableRooms() {
        $stmt = $this->db->prepare("SELECT * FROM Kamer WHERE KamerID NOT IN
            (SELECT KamerID FROM Reservering WHERE CheckOutDatum >= CURDATE())");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function maakReservering($klantID, $kamerID, $checkIn, $checkOut) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Reservering (KlantID, KamerID, CheckInDatum, CheckOutDatum)
                                        VALUES (:klantID, :kamerID, :checkIn, :checkOut)");
            $stmt->bindParam(':klantID', $klantID);
            $stmt->bindParam(':kamerID', $kamerID);
            $stmt->bindParam(':checkIn', $checkIn);
            $stmt->bindParam(':checkOut', $checkOut);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
