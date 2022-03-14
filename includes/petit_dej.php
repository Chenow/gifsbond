<?php
session_start();
ini_set('display_errors', 'on');
include_once 'connexion_bdd.php';


$telephone = intval($_POST["telephone"]);
$lieu = $_POST["lieu"];
$heure_livraison = $_POST["heure_livraison"];
$vege = "non";

if (isset($_POST["vege"])) {
    $vege = "oui";
}
$boisson = $_POST["boisson"];


//verification_cookies
if (63 * $_COOKIE["session_id_orgif"] + 45 != $_COOKIE['verification_id_orgif']) {
    //a changé les cookies
    header("Location: oauth_vr.php");
} else {

    //verification cotisant
    $sessionID = intval($_COOKIE['session_id_orgif']);
    $test_cotisant = "SELECT cotisant, statut from session_personnelle where sessionID='$sessionID';";
    $return = mysqli_fetch_row(mysqli_query($conn, $test_cotisant));
    $est_cotisant = $return[0];

    //verification pas commandé : 
    $test_commande = mysqli_query(
        $conn,
        "SELECT count(*) from petit_dej where sessionID =$sessionID;"
    );
    print_r($test_commande);

    $a_commandee = mysqli_fetch_row($test_commande)[0];
    echo $a_commandee;

    if (!"$est_cotisant" == "1") {
    } elseif ($a_commandee == 0) {

        $ajout_commande = "INSERT INTO petit_dej (telephone, lieu,heure_livraison, vege, boisson,sessionID) 
        VALUES ($telephone, '$lieu', '$heure_livraison','$vege','$boisson', $sessionID);";
        mysqli_query($conn, $ajout_commande);

        header("Location: ../accueil.php?commande=bon");
    } else {
        header("Location: ../accueil.php?commande=refuse");
    }
}
