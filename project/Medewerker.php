<?php
require_once "../hotelterduin/includes/db.php";

class Medewerker {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($gebruikersnaam, $wachtwoord) {
        $stmt = $this->db->prepare("SELECT * FROM Medewerker WHERE Gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $gebruikersnaam);
        $stmt->execute();

        $medewerker = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($medewerker && $wachtwoord === $medewerker['Wachtwoord']) {
            $_SESSION['login_status'] = true;
            $_SESSION['medewerker_id'] = $medewerker['MedewerkerID'];
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['login_status']) && $_SESSION['login_status'] == true;
    }

}
?>
