<?php
session_start();
ini_set('display_errors', 'on');
$dbServerName = "localhost";
$dbUsername = "root";
$dbPasseword = "2001antene";
$dbName = "bdd_bde";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPasseword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
setcookie("session_id_orgif", "", time() - 3600);
setcookie("verification_id_orgif", "", time() - 3600);

if (!isset($_GET["code"])) {
    //pas connecté 

    header("Location: https://auth.viarezo.fr/oauth/authorize?redirect_uri=https://www.gifsbond.fr/includes/oauth_vr.php&client_id=7d2c2e5d0475dfe615ca808cffd557171040d903&response_type=code&state=test&scope=default");
} else {
    //connecté

    //go chercher les 1er tokens
    $curl = curl_init();
    $infos_POST = array(
        "grant_type" => "authorization_code",
        "code" => $_GET["code"],
        "redirect_uri" => "https://www.gifsbond.fr/includes/oauth_vr.php",
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
    $firstName = $pseudo_array["firstName"];
    $lastName = $pseudo_array["lastName"];
    $email = $pseudo_array["email"];

    curl_close($ch);

    //go chercher si cotisant bde
    $cotis = curl_init();
    curl_setopt($cotis, CURLOPT_URL, "https://api.bde-cs.fr/api/v1/cotisants/check/$pseudo_VR");
    curl_setopt($cotis, CURLOPT_HTTPHEADER, array("X-API-Key: 7zmwy18b5RZ-0APmduPvM69Wo1rAMH5ZJ-YrG_me6U0"));
    curl_setopt($cotis, CURLOPT_RETURNTRANSFER, true);
    $reponse_cotisant = curl_exec($cotis);
    $cotisant = json_decode($reponse_cotisant, true)['cotisant'];
    curl_close($cotis);

    //go chercher si déjà pseudo_vr dans bdd
    $test_si_pseudo_vr = "SELECT pseudo_VR from session_personnelle where pseudo_VR='$pseudo_VR';";

    if (mysqli_num_rows(mysqli_query($conn, $test_si_pseudo_vr)) > 0) {

        $lecture_sessionID = "SELECT sessionID FROM session_personnelle
        WHERE pseudo_VR = '$pseudo_VR';";
        $sessionID = mysqli_fetch_row(mysqli_query($conn, $lecture_sessionID))[0];
        $verification_ID = 63 * $sessionID + 45;
        setcookie("session_id_orgif", $sessionID, time() + (86400 * 8), "/");
        setcookie("verification_id_orgif", $verification_ID, time() + (86400 * 8), "/");
        header('Location: ../accueil.php');
    } else {

        //go chercher si VIP ou blacklist
        $statut = "normal";
        $liste_VIP = array(

            "2020bernardar", "2020bhibri", "2020abath", "2020mentzce", "2020filleulki", "2020erhartje", "2020moudenme", "2020molinierle", "2020duchesneya", "2020bottraudlu", "2020beckol", "2020micheala", "2020marechalcl", "2020bodardxa", "2020fagardle", "2020regnierfe", "2020hashemmo", "2020louisse", "2020jouffrech", "2020heniqueth", "2020viennotlo", "2020hullerco", "2020lecorreme", "2020pecceninad", "2020benmoussot", "2020truffinero", "2020delalandsi", "2020laforcadpi",
            "2020bougnonth", "2020falliondma", "2020archambama", "2020guenfoudil", "2020dufresnema", "2020jacquemalo", "2020boureldefe", "2020benardti", "2020loumema", "2020royerja", "2020ferreolpa", "2020zarzourja", "2020correle", "2020groussinar", "2020charleufro", "2020roussetth", "2020dominicima", "2020ladraamo", "2020besnaultar", "2020arnaudth", "2020thevenethu", "2020wolffhu", "2020rigaudju", "2020garbalzo", "2020petrovicvl", "2020robincl", "2020hauseran",
            "2019deveveybr", "2019delebassro", "2019duhenyv", "2019rieffelcl", "2019tronchisi", "2019bouananihi", "2019larhchimam", "2019oddeva", "2019annequinma", "2019payanan", "2019vicensno", "2019fournierro", "2019quentinre", "2019peterje", "2019meotth", "2019petitar", "2019chauliaced", "2019chadaliyo", "2019moreauth", "2019hmyeneme", "2019falckal", "2019bennisme", "2019picardro", "2019brahimima", "2019lovisaem", "2019remyfl",
            "2019menegattem", "2019buscayleth", "2019blervacqta", "2019gravellino", "2019desbordeel", "2019felipbere", "2019dechamboet", "2019puissetlo", "2019serquinio", "2019mollolisa", "2019screminlo", "2019lapuentero", "2019tristantpa", "2019guenardad", "2019marthanpi", "2019salibapa", "2019porcherma", "2019raultma", "2019stepantco", "2019liji", "2019josseth", "2019porcherfr", "2019lacaperelo", "2019potieran", "2019clemotlu", "2019daugege",
            "2019houassbo", "2019louzaram", "2019tauberso", "2019metivieran", "2019melkni", "2019gruberte", "2019ravixju", "2019besserha", "2019chemiaa", "2019blomga", "2019ohierem", "2019ledieuar", "2019bouscaryma", "2019fevrierya", "2019leroyki", "2019monnetma", "2019sansacvi", "2019servanthu", "2019ferrandofl", "2019muhieddiug", "2019farahmi", "2019alalguizy", "2019collodelvi", "2019sokoundjch", "2019crozierpi", "2019saintjoajo", "2021charlesev"
        );
        $blacklist = array();
        if (in_array($pseudo_VR, $liste_VIP)) {
            $statut = "VIP";
        } else if (in_array($pseudo_VR, $blacklist)) {
            $statut = "blacklist";
        }


        //ecriture des tokens + pseudo_VR + cotisant dans la bdd
        $carte1 = rand(1, 52);
        $carte2 = rand(1, 52);
        $ajout_tokens = "INSERT INTO session_personnelle (prenom, nom, email, pseudo_VR,verification_ID, cotisant, commande_en_cours, statut, carte1 , carte2) 
        VALUES ('$firstName','$lastName', '$email','$pseudo_VR',0,'$cotisant','non', '$statut','$carte1', '$carte2' );";
        mysqli_query($conn, $ajout_tokens);

        //ecriture de verification_ID
        $lecture_sessionID = "SELECT sessionID FROM session_personnelle
        WHERE pseudo_VR = '$pseudo_VR';";
        $sessionID = mysqli_fetch_row(mysqli_query($conn, $lecture_sessionID))[0];
        $verification_ID = 63 * $sessionID + 45;
        mysqli_query($conn, "UPDATE session_personnelle SET verification_ID = $verification_ID WHERE pseudo_VR = '$pseudo_VR';");

        //creation d'un cookie session_id et verification_id
        setcookie("session_id_orgif", $sessionID, time() + (86400 * 8), "/");
        setcookie("verification_id_orgif", $verification_ID, time() + (86400 * 8), "/");

        //fin : go hotline_service
        header('Location: ../accueil.php');
    }
}
