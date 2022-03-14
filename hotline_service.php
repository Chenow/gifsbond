<?php session_start();
include_once 'includes/connexion_bdd.php';
$test_VIP = "normal";
if (isset($_COOKIE["session_id_orgif"])) {
    $sessionID = $_COOKIE["session_id_orgif"];
    $sql = "SELECT email from session_personnelle where sessionID = $sessionID;";
    $email = mysqli_fetch_row(mysqli_query($conn, $sql))[0];
    $test_VIP = "normal";
    $liste_VIP = array("guillaume.grasset-gothon@student-cs.fr", "anna.chanteux@student-cs.fr", "ghali.diouri@student-cs.fr", "clea.chataigner@student-cs.fr", "mehdi.badri@student-cs.fr", "elie.chadaida@student-cs.fr", "zineb.cherradi@student-cs.fr", "thibaud.arnaud@student-cs.fr", "charles.rocher@student-cs.fr", "corentin.ouillet@student-cs.fr", "paul.lestrat@student-cs.fr", "marie.bernard@student-cs.fr", "cyprien.pierrot@student-cs.fr", "quentin.delacroix@student-cs.fr", "anaïs.liquier@student-cs.fr z", "hugo.muller@student-cs.fr", "evann.charles@student-cs.fr", "arthur.bernard2@student-cs.fr", "riade.bhih@student-cs.fr", "thierry.aba@student-cs.fr", "cecile.mentz@student-cs.fr", "kiria.filleul@student-cs.fr", "adrien.peccenini@student-cs.fr", "erhart.jean@student-cs.fr", "othman.benmoussa@student-cs.fr", "leo.molinier@student-cs.fr", "mehdi.mouden@student-cs.fr", "yann.duchesne@student-cs.fr", "luis.bottraud@student-cs.fr", "robin.truffinet@student-cs.fr", "olivier.beck@student-cs.fr", "lancelot.michea@student-cs.fr", "simon.delalande@student-cs.fr", "clement.marechal@student-cs.fr", "xavier.bodard@student-cs.fr", "leo.fagard@student-cs.fr", "felix.regnier@student-cs.fr", "moustapha.hashem@student-cs.fr", "sebastien.louis@student-cs.fr", "charlotte.jouffre@student-cs.fr", "thibault.henique@student-cs.fr", "louis.viennot@student-cs.fr", "pierre-amaury.laforcade@student-cs.fr", "cornelia.huller@student-cs.fr", "melen.le-corre@student-cs.fr", "margaux.falliondalmonte@student-cs.fr", "maxime.archambault@student-cs.fr", "thomas.bougnon@student-cs.fr", "titouan.benard@student-cs.fr", "mathilde.loume@student-cs.fr", "ilyass.guenfoudi@student-cs.fr", "jack.royer@student-cs.fr", "paul.ferreol@student-cs.fr", "jad.zarzour@student-cs.fr", "leonard.corre@student-cs.fr", "arthur.groussin@student-cs.fr", "robin.charleuf@student-cs.fr", "thibault.rousset@student-cs.fr", "matthieu.dominici@student-cs.fr", "mohamed.ladraa@student-cs.fr", "mateo.dufresne-d-amico@student-cs.fr", "arthur.besnault@student-cs.fr", "louis.jacquemart@student-cs.fr", "thibaud.arnaud@student-cs.fr", "felix.de-la-ronciere@student-cs.fr", "hugo.thevenet@student-cs.fr", "hugo.wolff@student-cs.fr", "jules.rigaud@student-cs.fr", "zoe.garbal@student-cs.fr", "vladimir.petrovic@student-cs.fr", "claire.robin@student-cs.fr", "antoine.hauser@student-cs.fr", "victor.athanasio@student-cs.fr");
    if (in_array($email, $liste_VIP)) {
        $test_VIP = "VIP";
    }
} ?>


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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comforter&display=swap" rel="stylesheet">

    <!-- links css/js -->
    <link rel="stylesheet" href="css/hotline_service.css" />
    <script type="text/javascript" src="js/hotline_service.js"></script>

    <!-- données annexes -->
    <title>GIFSBOND</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />

</head>

<body>

    <?php include_once 'includes/navigation.php' ?>
    <!--============================== popup ==================================-->

    <?php
    $test_commande = "cache";

    if ($_GET["commande"] == "acceptee") {
        $test_commande = "acceptee";
    } elseif ($_GET["commande"] == "refusee") {
        $test_commande = "refusee";
    } elseif ($_GET["commande"] == "pas_cotisant")
        $test_commande = "pas_cotisant";
    ?>

    <div class="commande_acceptee_<?php echo $test_commande ?> commande_acceptee_cache">
        <p>Ta commande a bien été enregistrée !</p>
        <a onclick="retour_accueil()" class="cross">&times;</a>
    </div>

    <div class="commande_refusee_<?php echo $test_commande ?> commande_refusee_cache">
        <p>Tu as déjà commandé, attend que l'on te livre et tu pourras recommander nos délicieuses crêpes !</p>
        <a onclick="retour_accueil()" class="cross">&times;</a>
    </div>

    <div class="commande_<?php echo $test_commande ?> commande_refusee_cache">
        <p>Tu n'est pas cotisant(e) BDE, malheureusement nous ne sommes pas autorisés à te fournir en crêpes :( </p>
        <a onclick="retour_accueil()" class="cross">&times;</a>
    </div>

    <div id="blur">
        <!--============================== landing_hotline ==================================-->

        <section class="landing_hotline">
            <?php include_once 'includes/carrousel_background_hotline.php' ?>
        </section>

        <!--============================== banderole ==========================================-->
        <section class="banderole_accueil">

            <div id="transition_accueil_landing1">
            </div>

            <div id="transition_accueil_landing2">
            </div>

            <div id="transition_accueil_landing3">
            </div>
        </section>

        <!--============================== texte_informatif_hotline =========================-->

        <section class="texte_informatif_hotline">
            <h1>Notre Hotline Service</h1>
            <div class="divider div-transparent div-stopper"></div>
            <p>
                Les GIFS BOND ne sont pas que des espions hors-pairs: ce sont aussi des cuisiniers au palais fin ! A ta disposition, il y a une gamme de crêpes préparées dans les règles de l'art sur billigs ! N'hésite pas à te régaler (disclaimer : l'abus de crêpes est bon pour la santé) !
            </p>
        </section>

        <!--============================== crepe_separateur==================================-->

        <div class="crepe_icon_conteneur">
            <div class="crepe_separateur">
                <img src="images/crepe_icon.png" alt="">
            </div>
        </div>
        <!--============================== commande_standard ================================-->

        <section class="commande_standard">
            <div class="container2">
                <h1>Nos crêpes</h1>
                <div class="slider-outer">
                    <img src="images/arrow-left.png" class="prev" alt="Prev">
                    <div class="slider-inner">
                        <img src="images/image1.jpg" class="active">
                        <img src="images/image2.jpg">
                        <img src="images/image3.jpg">
                        <img src="images/image4.jpg">
                    </div>
                    <img src="images/arrow-right.png" class="next" alt="Next">
                </div>
            </div>
            <div id="lol">
                <p id="disclaimer">Les batiments de cours étant loin des cuisines, nous favorisons les livraisons en rez. Si vous souhaitez commander dans les batiments de cours nous vous conseillons d'aller au stand (régulierement livré en crêpes).</p>
            </div>
            <div class="center">
                <h1>Commande de Crêpes <?php if ($test_VIP == "VIP") {
                                            echo 'VIP';
                                        } ?></h1>
                <form method="POST">

                    <div class="txt_field">
                        <input name="telephone" type="text" required>
                        <span></span>
                        <label>Numéro de téléphone</label>
                    </div>
                    <div class="txt_field">
                        <input name="chambre_appartement" type="text" required>
                        <span></span>
                        <label>Chambre/Appartement</label>
                    </div>
                    <div class="gout_crepe">
                        <span>
                            Crêpe Nature (petite)
                            <div>
                                <input type="range" min="0" max="20" value="0" onchange="nombre_crepe()" oninput="this.nextElementSibling.value = this.value" id="crepe_nature" name="crepes_nature">

                                <output>0</output>
                            </div>
                        </span>

                        <span>Crêpe Sucrée (petite)
                            <div>
                                <input type="range" min="0" max="20" value="0" onchange="nombre_crepe()" oninput="this.nextElementSibling.value = this.value" id="crepe_sucre" name="crepes_sucre">
                                <output>0</output>
                            </div>
                        </span>

                        <span>Crêpe Nutella (petite)
                            <div><input type="range" min="0" max="20" value="0" onchange="nombre_crepe()" oninput="this.nextElementSibling.value = this.value" id="crepe_nutella" name="crepes_nutella">
                                <output>0</output>
                            </div>
                        </span>
                        <span class="<?php echo $test_VIP ?>">Grande Crêpe
                            <div><input type="range" min="0" max="2" value="0" oninput="this.nextElementSibling.value = this.value" id="grande_crepe" name="grande_crepe">
                                <output>0</output>
                            </div>
                        </span>
                        <span class="<?php echo $test_VIP ?>">Gaufre
                            <div><input type="range" min="0" max="1" value="0" oninput="this.nextElementSibling.value = this.value" id="grande_crepe" name="gaufre">
                                <output>0</output>
                            </div>
                        </span>
                        </span>
                    </div>

                    <?php
                    $test_cookies = "mauvais";
                    if (isset($_COOKIE["session_id_orgif"]) and isset($_COOKIE["verification_id_orgif"])) {
                        if (63 * $_COOKIE["session_id_orgif"] + 45 == $_COOKIE["verification_id_orgif"]) {
                            $test_cookies = "bon";
                        } else {
                            $test_cookies = "mauvais";
                        }
                    } ?>
                    <input type="submit" id="submit_<?php echo $test_cookies ?>" value="Temporairement fermée">
                    <div class="connexion_crepe" id="connexion_<?php echo $test_cookies
                                                                ?>">
                        <a href="includes/oauth_vr.php">
                            connexion
                        </a>
                    </div>
                </form>
            </div>
        </section>

        <?php include_once "includes/footer.php" ?>
    </div>

    <script>
        function nombre_crepe() {
            var crepe_nature = document.getElementById("crepe_nature");
            var crepe_sucre = document.getElementById("crepe_sucre");
            var crepe_nutella = document.getElementById("crepe_nutella");
            console.log(crepe_nature);
            crepe_nature.max = 7 - Number(crepe_sucre.value) - Number(crepe_nutella.value);
            crepe_sucre.max = 7 - Number(crepe_nature.value) - Number(crepe_nutella.value);
            crepe_nutella.max = 7 - Number(crepe_nature.value) - Number(crepe_sucre.value);

            crepe_nature.nextElementSibling.value = crepe_nature.value
            crepe_sucre.nextElementSibling.value = crepe_sucre.value
            crepe_nutella.nextElementSibling.value = crepe_nutella.value

        }
    </script>


    <script type="text/javascript">
        var counter = 1;
        setInterval(function() {
            document.getElementById("radio" + counter).checked = true;
            counter++;
            if (counter > 4) {
                counter = 1;
            }
        }, 5000);
    </script>


    <script>
        function retour_accueil() {
            $('#blur').css("filter", "blur(0)");
            $(".commande_acceptee_acceptee").css("opacity", "0");
            $(".commande_refusee_refusee").css("opacity", "0");
            $(".commande_pas_cotisant").css("opacity", "0");

            setTimeout(function() {
                $(".commande_acceptee_acceptee").css("z-index", "-1");
                $(".commande_refusee_refusee").css("z-index", "-1");
                $(".commande_pas_cotisant").css("z-index", "-1");

            }, 1000)();

        }

        function video_popup_acceptee() {
            $('#blur').css("filter", "blur(20px)");
            $(".commande_acceptee_acceptee").css("z-index", "2");
            $(".commande_acceptee_acceptee").css("opacity", "1");
        }

        function video_popup_refusee() {
            $('#blur').css("filter", "blur(20px)");
            $(".commande_refusee_refusee").css("z-index", "2");
            $(".commande_refusee_refusee").css("opacity", "1");
        }


        function video_popup_pas_cotisant() {
            $('#blur').css("filter", "blur(20px)");
            $(".commande_pas_cotisant").css("z-index", "2");
            $(".commande_pas_cotisant").css("opacity", "1");
        }

        if ("<?php echo $_GET["commande"] ?>" === "refusee") {
            video_popup_refusee();
        } else if ("<?php echo $_GET["commande"] ?>" === "acceptee") {
            video_popup_acceptee();
        } else if ("<?php echo $_GET["commande"] ?>" === "pas_cotisant") {
            video_popup_pas_cotisant();
        }
    </script>

</body>

</script>

</html>