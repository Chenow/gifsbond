<?php
session_start();
ini_set('display_errors', 'on');
include_once 'includes/connexion_bdd.php';

$mdp = $_POST["mdp"];
$debut_destroy = intval($_POST["debut_destroy"]);
$fin_destroy = intval($_POST["fin_destroy"]);

if ($fin_destroy - $debut_destroy > 100) {
    echo "tu ne peux pas supprimer plus de 50 commandes à la fois";
} elseif (!$mdp == '384713') {
    echo "mauvais mdp";
} else {
    if (!$debut_destroy == "" and !$fin_destroy == "") {
        for ($id = $debut_destroy; $id <= $fin_destroy; $id++) {
            $sessionID = mysqli_fetch_row(mysqli_query($conn, "SELECT sessionID from commandes_crepe where id='$id';"))[0];
            mysqli_query($conn, "UPDATE session_personnelle SET commande_en_cours = 'non' WHERE sessionID = '$sessionID';");
            mysqli_query($conn, "UPDATE commandes_crepe SET commande_en_cours = 'non' WHERE id = '$id';");
        }
    }

    echo "<br>";
    echo "<br>";
    $result = mysqli_query($conn, "SELECT * from commandes_crepe WHERE commande_en_cours = 'oui';");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        echo " <div id='$id' style='background-color:none;'>commande n°: " . $row["id"] .  "&nbsp&nbsp&nbsp sessionID : " . $row["sessionID"] .  "    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp tel : " . $row["telephone"] . "  &nbsp&nbsp&nbsp&nbsp lieu : " . $row["chambre_appartement"] . " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Nature: " . $row["crepes_nature"] . "  &nbsp&nbsp&nbsp Sucre: " . $row["crepes_sucre"] . " &nbsp&nbsp&nbsp  Nutella: " . $row["crepes_nutella"] . '&nbsp&nbsp&nbsp horaire commande : ' . $row["horaire_commande"] . "</div>";
        echo "<br>";
        echo "<br>";
    }
    echo '<script type="text/javascript">
        function color(elm){elm.parentNode.setAttribute("background-color","red")}
        </script>';
    echo "<br>";
    echo "COMMANDE VIP :";
    echo "<br>";

    $result = mysqli_query($conn, "SELECT * from commandes_crepe_VIP WHERE commande_en_cours = 'oui';");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        echo " <div id='$id' style='color:red;';'>commande n°: " . $row["id"] .  "&nbsp&nbsp&nbsp sessionID : " . $row["sessionID"] .  "    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp tel : " . $row["telephone"] . "  &nbsp&nbsp&nbsp&nbsp lieu : " . $row["chambre_appartement"] . " &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp  Nature: " . $row["crepes_nature"] . "  &nbsp&nbsp&nbsp Sucre: " . $row["crepes_sucre"] . " &nbsp&nbsp&nbsp  Nutella: " . $row["crepes_nutella"] . '&nbsp&nbsp&nbsp grande crêpe : ' . $row["grande_crepe"] . '  &nbsp&nbsp&nbsp gaufre : ' . $row["gaufre"] . '&nbsp&nbsp&nbsp horaire commande : ' . $row["horaire_commande"] . "</div>";
        echo "<br>";
        echo "<br>";
    }
}
