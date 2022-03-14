<?php session_start();
include_once 'includes/connexion_bdd.php';
$test_VIP = "normal";
if (isset($_COOKIE["session_id_orgif"])) {
    $sessionID = $_COOKIE["session_id_orgif"];
    $sql = "SELECT email from session_personnelle where sessionID = $sessionID;";
    $email = mysqli_fetch_row(mysqli_query($conn, $sql))[0];
    $test_VIP = "normal";
    $liste_VIP = array("antoine.cheneau@student-cs.fr", "arthur.bernard2@student-cs.fr", "riade.bhih@student-cs.fr", "thierry.aba@student-cs.fr", "cecile.mentz@student-cs.fr", "kiria.filleul@student-cs.fr", "adrien.peccenini@student-cs.fr", "erhart.jean@student-cs.fr", "othman.benmoussa@student-cs.fr", "leo.molinier@student-cs.fr", "mehdi.mouden@student-cs.fr", "yann.duchesne@student-cs.fr", "luis.bottraud@student-cs.fr", "robin.truffinet@student-cs.fr", "olivier.beck@student-cs.fr", "lancelot.michea@student-cs.fr", "simon.delalande@student-cs.fr", "clement.marechal@student-cs.fr", "xavier.bodard@student-cs.fr", "leo.fagard@student-cs.fr", "felix.regnier@student-cs.fr", "moustapha.hashem@student-cs.fr", "sebastien.louis@student-cs.fr", "charlotte.jouffre@student-cs.fr", "thibault.henique@student-cs.fr", "louis.viennot@student-cs.fr", "pierre-amaury.laforcade@student-cs.fr", "cornelia.huller@student-cs.fr", "melen.le-corre@student-cs.fr", "margaux.falliondalmonte@student-cs.fr", "maxime.archambault@student-cs.fr", "thomas.bougnon@student-cs.fr", "titouan.benard@student-cs.fr", "mathilde.loume@student-cs.fr", "ilyass.guenfoudi@student-cs.fr", "jack.royer@student-cs.fr", "paul.ferreol@student-cs.fr", "jad.zarzour@student-cs.fr", "leonard.corre@student-cs.fr", "arthur.groussin@student-cs.fr", "robin.charleuf@student-cs.fr", "thibault.rousset@student-cs.fr", "matthieu.dominici@student-cs.fr", "mohamed.ladraa@student-cs.fr", "mateo.dufresne-d-amico@student-cs.fr", "arthur.besnault@student-cs.fr", "louis.jacquemart@student-cs.fr", "thibaud.arnaud@student-cs.fr", "felix.de-la-ronciere@student-cs.fr", "hugo.thevenet@student-cs.fr", "hugo.wolff@student-cs.fr", "jules.rigaud@student-cs.fr", "zoe.garbal@student-cs.fr", "vladimir.petrovic@student-cs.fr", "claire.robin@student-cs.fr", "antoine.hauser@student-cs.fr", "victor.athanasio@student-cs.fr");
    if (in_array($email, $liste_VIP)) {
        $test_VIP = "VIP";
    }
}

date_default_timezone_set('Europe/Paris');
echo  date('H:i');
