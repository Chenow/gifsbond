<?php session_start();
include_once 'includes/connexion_bdd.php';
if (isset($_COOKIE["session_id_orgif"])) {
    $sessionID = $_COOKIE["session_id_orgif"];
    $sql = "SELECT carte1, carte2 from session_personnelle where sessionID = '$sessionID';";
    $cartes = mysqli_fetch_row(mysqli_query($conn, $sql));
    $carte1 = $cartes[0];
    $carte2 = $cartes[1];
}
