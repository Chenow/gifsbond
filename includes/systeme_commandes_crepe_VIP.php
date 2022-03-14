<?php
session_start();
ini_set('display_errors', 'on');
include_once 'connexion_bdd.php';

$sessionID = intval($_COOKIE["session_id_orgif"]);
//verification_cookies
if (63 * $_COOKIE["session_id_orgif"] + 45 != $_COOKIE['verification_id_orgif']) {
    //a changé les cookies
    header("Location: oauth_vr.php");
} else {
    $test_commande = mysqli_query(
        $conn,
        "SELECT commande_en_cours from session_personnelle where sessionID =$sessionID;"
    );
    $a_commandee = mysqli_fetch_row($test_commande)[0];

    if ("$a_commandee" == "oui") {
        //la personne a déjà une commande en cours
        header("Location: ../hotline_service.php?commande=refusee");
    } else {
        $telephone = intval($_POST['telephone']);
        $chambre_appartement = $_POST["chambre_appartement"];
        $crepes_nature = intval($_POST["crepes_nature"]);
        $crepes_sucre = intval($_POST["crepes_sucre"]);
        $crepes_nutella = intval($_POST["crepes_nutella"]);
        $grande_crepe = intval($_POST["grande_crepe"]);
        $gaufre = intval($_POST["gaufre"]);

        date_default_timezone_set('Europe/Paris');
        $time = date('H:i');

        $ajout_commande = "INSERT INTO commandes_crepe_VIP (telephone, chambre_appartement, crepes_nature, crepes_sucre, crepes_nutella,commande_en_cours,sessionID, grande_crepe, gaufre, horaire_commande) 
        VALUES ($telephone, '$chambre_appartement', $crepes_nature,$crepes_sucre,$crepes_nutella, 'oui',$sessionID, $grande_crepe, $gaufre, '$time');";
        mysqli_query($conn, $ajout_commande);

        mysqli_query($conn, "UPDATE session_personnelle SET commande_en_cours = 'oui' WHERE sessionID = $sessionID;");
        header("Location: ../hotline_service.php?commande=acceptee");
    }
}
