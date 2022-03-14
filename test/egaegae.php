<?php session_start();
ini_set('display_errors', 'on');
include_once '../includes/connexion_bdd.php';


if (isset($_COOKIE["session_id_orgif"])) {
    $sessionID = $_COOKIE["session_id_orgif"];
    $sql = "SELECT statut from session_personnelle where sessionID = $sessionID;";
    $test_VIP = mysqli_fetch_row(mysqli_query($conn, $sql))[0];
    if (!"$test_VIP" == "VIP") {
        $test_VIP = "a";
    }
}

echo $test_VIP;
echo gettype($test_VIP);

echo (2 == 2);
echo ("$test_VIP" == 'VIP');

$sessionID = $_COOKIE['session_id_orgif'];
$test_cotisant = "SELECT cotisant, statut from session_personnelle where sessionID='$sessionID';";
$return = mysqli_fetch_row(mysqli_query($conn, $test_cotisant));
$est_cotisant = $return[0];
$est_blacklist = $return[1];

echo "$est_cotisant";
echo "$est_blacklist";
