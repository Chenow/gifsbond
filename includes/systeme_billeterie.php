<?php
session_start();
ini_set('display_errors', 'on');
include_once 'connexion_bdd.php';

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$adresse_mail = $_POST['adresse_mail'];
$liste_client = mysqli_query($conn, "SELECT clientID FROM client;");
$test_adresse_mail = mysqli_query($conn, "SELECT adresse_mail FROM client
WHERE adresse_mail='$adresse_mail';");
$nombre_client = mysqli_num_rows($liste_client);

if ($nombre_client > 400) {
    $_SESSION["resultat_achat"] = "billeterie_epuisee";
    header("Location: ../billeterie.php?réservation=billeterie_épuisée");
} else if (mysqli_num_rows($test_adresse_mail) > 0) {
    $_SESSION["resultat_achat"] = "email_deja_utilise";
    header("Location: ../billeterie.php?email_déjà_utilisé");
} else {
    $ajout_client = "INSERT INTO client (nom, prenom, adresse_mail)
        VALUES ('$nom', '$prenom', '$adresse_mail');";
    mysqli_query($conn, $ajout_client);
    $_SESSION["resultat_achat"] = "place_reservee";
    header("Location: ../billeterie.php?place_réservée");
}
