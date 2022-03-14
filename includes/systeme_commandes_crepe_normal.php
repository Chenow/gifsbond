<?php
session_start();
ini_set('display_errors', 'on');
include_once 'connexion_bdd.php';


//verification_cookies
if (63 * $_COOKIE["session_id_orgif"] + 45 != $_COOKIE['verification_id_orgif']) {
    //a changé les cookies
    header("Location: oauth_vr.php");
} else {

    //verification cotisant
    $sessionID = $_COOKIE['session_id_orgif'];
    $test_cotisant = "SELECT cotisant, statut from session_personnelle where sessionID='$sessionID';";
    $return = mysqli_fetch_row(mysqli_query($conn, $test_cotisant));
    $est_cotisant = $return[0];
    $est_blacklist = $return[1];

    if (!"$est_cotisant" == "1") {
        header("Location: ../hotline_service.php?commande=pas_cotisant");
    } else {
        $test_commande = mysqli_query(
            $conn,
            "SELECT commande_en_cours from session_personnelle where sessionID =$sessionID;"
        );
        $a_commandee = mysqli_fetch_row($test_commande)[0];

        if ("$a_commandee" == "oui") {
            //la personne a déjà une commande en cours
            $_SESSION["resultat_commande_crepe"] = "commande_refusee";
            header("Location: ../hotline_service.php?commande=refusee");
        } else {


            //la commande a été enregistrée
            $_SESSION["resultat_commande_crepe"] = "commande_faite";

            $telephone = intval($_POST['telephone']);
            $chambre_appartement = $_POST["chambre_appartement"];
            $crepes_nature = intval($_POST["crepes_nature"]);
            $crepes_sucre = intval($_POST["crepes_sucre"]);
            $crepes_nutella = intval($_POST["crepes_nutella"]);


            date_default_timezone_set('Europe/Paris');
            $time = date('H:i');
            $ajout_commande = "INSERT INTO commandes_crepe (telephone, chambre_appartement, crepes_nature, crepes_sucre, crepes_nutella,commande_en_cours,sessionID, horaire_commande) 
            VALUES ($telephone, '$chambre_appartement', $crepes_nature,$crepes_sucre,$crepes_nutella, 'oui',$sessionID, '$time');";
            mysqli_query($conn, $ajout_commande);
            header("Location: ../hotline_service.php?commande=acceptee");

            mysqli_query($conn, "UPDATE session_personnelle SET commande_en_cours = 'oui' WHERE sessionID = $sessionID;");
            header("Location: ../hotline_service.php?commande=acceptee");
        }
    }
}
