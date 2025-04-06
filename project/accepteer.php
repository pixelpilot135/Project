<?php
require_once "../hotelterduin/includes/Dashboard1.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reservering_id'])) {
    $reserveringID = $_POST['reservering_id'];
    $dashboard = new Dashboard();
    $dashboard->acceptReservation($reserveringID);
    header("Location: dashboard.php");
    exit();
}
?>
