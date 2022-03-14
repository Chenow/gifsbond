<?php
$place_reservee = "message_cache";
$billeterie_epuisee = "message_cache";
$email_deja_utilise = "message_cache";

if (isset($_SESSION["resultat_achat"])) {
    if ($_SESSION["resultat_achat"] == "place_reservee") {
        $place_reservee = "message_place_reservee";
    } elseif ($_SESSION["resultat_achat"] == "billeterie_epuisee") {
        $billeterie_epuisee = "message_billeterie_epuisee";
    } elseif ($_SESSION["resultat_achat"] == "email_deja_utilise") {
        $email_deja_utilise = "message_email_deja_utilise";
    }
}
?>

<div id="popup1" class="<?php echo $place_reservee ?>">
    <div class="popup">
        <h2>Shotgun de la soirée</h2>
        <a onclick="retour_billeterie()" class="cross">&times;</a>
        <p>Tu as bien réservé une place !</p>
    </div>
</div>


<div id="popup2" class="<?php echo $billeterie_epuisee ?>">
    <div class="popup">
        <h2>Shotgun de la soirée</h2>
        <a class="cross" onclick="retour_billeterie()">&times;</a>
        <p>Il n'y a plus de places.</p>
    </div>
</div>


<div id="popup3" class="<?php echo $email_deja_utilise ?>">
    <div class="popup">
        <h2>Shotgun de la soirée</h2>
        <a onclick="retour_billeterie()" class="cross">&times;</a>
        <p>Ton email a déjà été utilisé.</p>
    </div>
</div>

<style>
    .box {
        position: absolute 50%;
        width: 3x;
        margin: 10rem auto;
        padding-top: 10rem;
        background: grey;
        padding: 2.5rem;
        border: 2px solid #ddd;
        border-radius: 20px/50px;

    }

    .button {
        font-size: 1.3rem;
        padding: 1rem;
        color: #fff;
        border: 2px solid #12fcf8;
        border-radius: 20px/50px;
        text-decoration: none;
        cursor: pointer;
        background: rgba(10, 149, 147, 0.25);
        transition: all 0.3s ease-out;
    }

    .button:hover {
        background: #12fcf8;
        color: #333;
    }

    .message_place_reservee {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 0.4s;
        pointer-events: auto;
        opacity: 1;
        z-index: 3;
    }

    .message_billeterie_epuisee {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 0.4s;
        pointer-events: auto;
        opacity: 1;
        z-index: 3;
    }

    .message_email_deja_utilise {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 0.4s;
        pointer-events: auto;
        opacity: 1;
        z-index: 3;
    }

    .message_cache {
        position: absolute;
        z-index: -10;
        opacity: 0;
        transition: opacity 0.4s;
    }

    .popup {
        margin: 6rem auto;
        padding: 2rem;
        background: white;
        border-radius: 5px;
        width: 45%;
        position: relative;
        transition: all 0.4 ease-in-out;
    }

    .popup .cross {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 2rem;
        font-weight: bold;
        text-decoration: none;
        transition: 0.4s ease;
    }

    .popup .cross:hover {
        color: #12fcf8;
        cursor: pointer;
    }
</style>

<script>
    function retour_billeterie() {
        $("#popup1").removeClass("message_place_reservee").addClass("message_cache");
        $("#popup2").removeClass("message_billeterie_epuisee").addClass("message_cache");
        $("#popup3").removeClass("message_email_deja_utilise").addClass("message_cache");
    }
    <?php $_SESSION["resultat_achat"] = "" ?>
</script>