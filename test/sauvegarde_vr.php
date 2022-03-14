<?php
session_start();
include_once 'connexion_bdd.php';
ini_set('display_errors', 'on');

setcookie("session_id_orgif", "", time() - 3600);

if (!isset($_GET["code"])) {
    //pas connecté 

    header("Location: https://auth.viarezo.fr/oauth/authorize?redirect_uri=http://138.195.139.167/orgif/includes/oauth_vr.php&client_id=7d2c2e5d0475dfe615ca808cffd557171040d903&response_type=code&state=test&scope=default");
} else {
    //connecté

    //go chercher les 1er tokens
    $curl = curl_init();
    $infos_POST = array(
        "grant_type" => "authorization_code",
        "code" => $_GET["code"],
        "redirect_uri" => "http://138.195.139.167/orgif/includes/oauth_vr.php",
        "client_id" => "7d2c2e5d0475dfe615ca808cffd557171040d903",
        "client_secret" => "144eba2e5751728f0914ec388d774ee0754721e1"
    );

    $infos_POST = http_build_query($infos_POST);
    $options = array(
        CURLOPT_URL => 'https://auth.viarezo.fr/oauth/token',
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $infos_POST,
        CURLOPT_HTTPHEADER => array("content-type:application/x-www-form-urlencoded"),
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    $tokens_array = json_decode($response, true);
    curl_close($curl);

    //go chercher pseudo_VR
    $ch = curl_init();
    $access_token = $tokens_array["access_token"];
    curl_setopt($ch, CURLOPT_URL, "https://auth.viarezo.fr/api/user/show/me");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:Bearer $access_token"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_pseudo = curl_exec($ch);
    $pseudo_array = json_decode($response_pseudo, true);
    $pseudo_VR = $pseudo_array["login"];
    curl_close($ch);

    //go chercher si cotisant bde
    $cotis = curl_init();
    curl_setopt($cotis, CURLOPT_URL, "https://api.bde-cs.fr/api/v1/cotisants/check/$pseudo_VR");
    curl_setopt($cotis, CURLOPT_HTTPHEADER, array("X-API-Key: 7zmwy18b5RZ-0APmduPvM69Wo1rAMH5ZJ-YrG_me6U0"));
    curl_setopt($cotis, CURLOPT_RETURNTRANSFER, true);
    $reponse_cotisant = curl_exec($cotis);
    $cotisant = json_decode($reponse_cotisant, true)['cotisant'];
    curl_close($cotis);

    //ecriture des tokens + pseudo_VR + cotisant dans la bdd

    $refresh_token = $tokens_array["refresh_token"];
    $ajout_tokens = "INSERT INTO session_personnelle (access_token, refresh_token,pseudo_VR,verification_ID, cotisant, commande_en_cours) 
        VALUES ('$access_token','$refresh_token','$pseudo_VR',0,'$cotisant','non');";
    mysqli_query($conn, $ajout_tokens);

    //ecriture de verification_ID
    $lecture_sessionID = "SELECT sessionID FROM session_personnelle
        WHERE access_token = '$access_token';";
    $sessionID = mysqli_fetch_row(mysqli_query($conn, $lecture_sessionID))[0];
    $verification_ID = 63 * $sessionID + 45;
    mysqli_query($conn, "UPDATE session_personnelle SET verification_ID = $verification_ID WHERE sessionID = $sessionID;");

    //creation d'un cookie session_id et verification_id
    setcookie("session_id_orgif", $sessionID, time() + (86400 * 8), "/");
    setcookie("verification_id_orgif", $verification_ID, time() + (86400 * 8), "/");

    //fin : go hotline_service
    header("Location: ../accueil.php");
}
