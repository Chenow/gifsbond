<!DOCTYPE html>
<html lang='fr'>

<head>
    <!-- debug @media -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jquery import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- font-style import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comforter&display=swap" rel="stylesheet">

    <!-- links css/js -->
    <link rel="stylesheet" href="a.css" />
    <script type="text/javascript" src="js/accueil.js"></script>

    <!-- données annexes -->
    <title>GIFSBOND</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />
</head>

<body>


    <section class="petit_dej">
        <div class="center">
            <h1>Commande Petit Déjeuné</h1>
            <form method="POST" action="includes/petit_dej.php">

                <div class="txt_field">
                    <input name="telephone" type="text" required>
                    <span></span>
                    <label>Numéro de téléphone</label>
                </div>
                <div class="txt_field">
                    <input name="lieu" type="text" required>
                    <span></span>
                    <label>Chambre/Appartement</label>
                </div>
                <div class="txt_field">
                    <input name="heure_livraison" type="text" required>
                    <span></span>
                    <label>Heure de livraison (entre 6h et 10h)</label>
                </div>
                <div class="gout_crepe">
                    <span>
                        Option végétarien
                        <div>
                            <input type="checkbox" id="crepe_nature" name="vege">
                        </div>
                    </span>
                    <span>Boisson
                        <div>
                            <input type="radio" id="chocolat_chaud" name="boisson" value="chocolat chaud" checked>
                            <label for="boisson">chocolat chaud</label>
                        </div>
                        <div>
                            <input type="radio" id="the" name="boisson" value="Thé">
                            <label for="the">Thé</label>
                        </div>
                        <div>
                            <input type="radio" id="cafe" name="boisson" value="Café">
                            <label for="cafe">Café</label>
                        </div>
                    </span>



                    <?php
                    $test_cookies = "mauvais";
                    if (isset($_COOKIE["session_id_orgif"]) and isset($_COOKIE["verification_id_orgif"])) {
                        if (63 * $_COOKIE["session_id_orgif"] + 45 == $_COOKIE["verification_id_orgif"]) {
                            $test_cookies = "bon";
                        } else {
                            $test_cookies = "mauvais";
                        }
                    } ?>
                    <input type="submit" id="submit_<?php echo $test_cookies ?>" value="Commande">
                    <div class="connexion_crepe" id="connexion_<?php echo $test_cookies
                                                                ?>">
                        <a href="includes/oauth_vr.php">
                            connexion
                        </a>
                    </div>
            </form>
        </div>
    </section>

</body>

</html>