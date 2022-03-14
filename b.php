<?php
session_start();
ini_set('display_errors', 'on');
include_once 'includes/connexion_bdd.php';

$mdp = $_POST["mdp"];

$debut_destroy = $_POST["debut_destroy"];
$fin_destroy = $_POST["fin_destroy"];

if ($fin_destroy - $debut_destroy > 50) {
    echo "tu ne peux pas supprimer plus de 50 commandes à la fois";
}
echo $mdp;
if (!$mdp == "384713") {
    header("Location: accueil.php");
    echo "test2";
} else {
    echo "lol";
}
