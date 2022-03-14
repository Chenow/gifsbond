<?php
session_start();
include_once 'connexion_bdd.php';
ini_set('display_errors', 'on');

if (isset($_COOKIE["session_id_orgif"])) {
    //s'est déjà connecté
    $current_date = date('y-m-d h:i:s');
    $sessionID = $_COOKIE["session_id_orgif"];
    $fetch_expires_at = "SELECT expires_at FROM session_personnelle
            WHERE sessionID = '$sessionID';";
    $expires_at =  mysqli_fetch_row(mysqli_query($conn, $fetch_expires_at))[0];

    if ($current_date < $expires_at) {
        //access_token tjr valable

        //go chercher access_token
        $fetch_access_token = "SELECT access_token FROM session_personnelle
                WHERE sessionID = '$sessionID';";
        $access_token =  mysqli_fetch_row(mysqli_query($conn, $fetch_access_token))[0];

        //go chercher pseudo_VR
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://auth.viarezo.fr/api/user/show/me");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:Bearer$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_pseudo = curl_exec($ch);
        $pseudo_array = json_decode($response_pseudo, true);
        $pseudo_VR = $pseudo_array["login"];
        curl_close($ch);

        //go chercher si cotisant bde
        $cotis = curl_init();
        curl_setopt($cotis, CURLOPT_URL, "https://auth.viarezo.fr/api/user/show/me");
        curl_setopt($cotis, CURLOPT_HTTPHEADER, array("Authorization:Bearer"));
        curl_setopt($cotis, CURLOPT_RETURNTRANSFER, true);
        $reponse_cotisant = curl_exec($cotis);
        $cotisant_array = json_decode($reponse_cotisant, true);
        $_SESSION["cotisation_bde"] = $cotisant_array["cotisant"];
        curl_close($cotis);

        //fin : go hotline_service
        header("Location: ../hotline_service.php");
    } else {
        //access_token plus valable

        //go chercher refresh_token
        $fetch_refresh_token = "SELECT refresh_token FROM session_personnelle
                WHERE sessionID = '$sessionID';";
        $refresh_token =  mysqli_fetch_row(mysqli_query($conn, $fetch_refresh_token))[0];

        //go renouveler l'access token
        $curl = curl_init();
        $infos_POST = array(
            "grant_type" => "authorization_code",
            "code" => $_GET["code"],
            "redirect_uri" => "http://localhost/includes/oauth_vr.php",
            "client_id" => "7d2c2e5d0475dfe615ca808cffd557171040d903",
            "client_secret" => "144eba2e5751728f0914ec388d774ee0754721e1"
        );
        $options = array(
            CURLOPT_URL => 'https://auth.viarezo.fr/oauth/token',
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $infos_POST,
            CURLOPT_HTTPHEADER => array("content-type:x-www-form-urlencoded"),
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        $tokens_array = json_decode($response, true);
        curl_close($curl);

        //ecriture des tokens dans la bdd
        $access_token = $tokens_array["access_token"];
        $refresh_token = $tokens_array["refresh_token"];
        $expires_at =  $tokens_array["expires_at"];
        $ajout_tokens = "INSERT INTO session_personnelle (access_token,expires_at, refresh_token) 
            VALUES ('$access_token', '$expires_at','$refresh_token');";
        mysqli_query($conn, $ajout_tokens);

        //creation d'un cookie session_id
        $lecture_sessionID = "SELECT sessionID FROM session_personnelle
            WHERE access_token = '$access_token';";
        $_COOKIE["session_id_orgif"]  =  mysqli_fetch_row(mysqli_query($conn, $lecture_sessionID))[0];

        //go chercher pseudo_VR
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://auth.viarezo.fr/api/user/show/me");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:Bearer$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_pseudo = curl_exec($ch);
        $pseudo_array = json_decode($response_pseudo, true);
        $pseudo_VR = $pseudo_array["login"];
        curl_close($ch);

        //go chercher si cotisant bde
        $cotis = curl_init();
        curl_setopt($cotis, CURLOPT_URL, "https://auth.viarezo.fr/api/user/show/me");
        curl_setopt($cotis, CURLOPT_HTTPHEADER, array("Authorization:Bearer"));
        curl_setopt($cotis, CURLOPT_RETURNTRANSFER, true);
        $reponse_cotisant = curl_exec($cotis);
        $cotisant_array = json_decode($reponse_cotisant, true);
        $_SESSION["cotisation_bde"] = $cotisant_array["cotisant"];
        curl_close($cotis);

        //fin : go hotline_service
        header("Location: /localhost/hotline_service.php");
    }
} else {

    //1ère connexion
    if (!isset($_GET["code"])) {
        //pas connecté 

        header("Location: https://auth.viarezo.fr/oauth/authorize?redirect_uri=http://localhost/orgif/includes/oauth_vr.php&client_id=7d2c2e5d0475dfe615ca808cffd557171040d903&response_type=code&state=test&scope=default");
    } else {
        //connecté

        //go chercher les 1er tokens
        $curl = curl_init();
        $infos_POST = array(
            "grant_type" => "authorization_code",
            "code" => $_GET["code"],
            "redirect_uri" => "http://localhost/orgif/includes/oauth_vr.php",
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

        //ecriture des tokens dans la bdd
        $access_token = $tokens_array["access_token"];
        $refresh_token = $tokens_array["refresh_token"];
        print_r($access_token);
        $ajout_tokens = "INSERT INTO session_personnelle (access_token,refresh_token) 
        VALUES ('$access_token','$refresh_token');";
        mysqli_query($conn, $ajout_tokens);

        //creation d'un cookie session_id
        $lecture_sessionID = "SELECT sessionID FROM session_personnelle
            WHERE access_token = '$access_token';";
        $_COOKIE["session_id_orgif"]  =  mysqli_fetch_row(mysqli_query($conn, $lecture_sessionID))[0];

        //go chercher pseudo_VR
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://auth.viarezo.fr/api/user/show/me");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_pseudo = curl_exec($ch);
        $pseudo_array = json_decode($response_pseudo, true);
        print_r($pseudo_array);
        $pseudo_VR = $pseudo_array["login"];
        curl_close($ch);

        //go chercher si cotisant bde
        $cotis = curl_init();
        curl_setopt($cotis, CURLOPT_URL, "https://api.bde-cs.fr/api/v1/cotisants/check/$pseudo_VR");
        curl_setopt($cotis, CURLOPT_HTTPHEADER, array("X-API-Key: 7zmwy18b5RZ-0APmduPvM69Wo1rAMH5ZJ-YrG_me6U0"));
        curl_setopt($cotis, CURLOPT_RETURNTRANSFER, true);
        $reponse_cotisant = curl_exec($cotis);
        $cotisant_array = json_decode($reponse_cotisant, true);
        print_r($reponse_cotisant);
        curl_close($cotis);


        //fin : go hotline_service
    }
}
