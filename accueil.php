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
    <link rel="stylesheet" href="css/accueil.css" />
    <script type="text/javascript" src="js/accueil.js"></script>

    <!-- données annexes -->
    <title>GIFSBOND</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />
</head>

<body>

    <?php include_once 'includes/navigation.php' ?>
    <div id="video_popup">
        <video controls>
            <source src="images/Good evening.mp4" type="video/mp4">
        </video>
        <a onclick="retour_accueil()" class="cross">&times;</a>
    </div>
    <div id="blur">

        <!--============================== accueil_landing ==========================================-->


        <section class="accueil_landing">
            <img src="images/logo_sans_fond.png" id="logo_sans_fond">
            <div class="liens_boxes">
                <div><a href="hotline_service.php">Commande Crêpe</a></div>
                <div><a href="les_actis.php">Les actis</a></div>
                <div><a href="la_liste.php">Qui sommes nous ?</a></div>
            </div>
            <?php include_once 'includes/carrousel_background_accueil.php' ?>
        </section>

        <!--============================== banderole ==========================================-->
        <!--============================== accueil_presentation =============================-->


        <section class="accueil_presentation">
            <div class="banderole_reseaux">
                <div class="logo_insta">
                    <img src="images/logo_insta.png">
                    <a href="https://www.instagram.com/gifs_bond/">Notre Instagram</a>
                </div>
                <div class="logo_fb">
                    <a href="https://www.facebook.com/gifs.bond/">Notre facebook</a>
                    <img src="images/logo_fb.png">
                </div>
            </div id="blur">
            <div class="divider"><span></span><span>GIFS BOND</span><span></span></div>
            <div class="texte_presentation">
                <div class="box_text">
                    <p>GIFS BOND n'est pas une simple liste BDE, entre activités innovantes, engagements pour le campus, et respect de chacun , elle est la liste dont CS a besoin !</p>
                    <p>Pendant cette semaine de folie, les GIFS BOND seront toujours là pour te faire sourire ! Tu nous verras présents partout sur le campus, que se soit au detour d'une livraison de crêpe, pendant nos soirées/befores ou au cours des nombreuses activités délirantes organisées pour toi ! </p>
                </div>
                <div class="actus">
                    <p>Les Activités de la journée</p>
                    <p>Hotline enlevement : 07 69 15 25 22</p>
                    <p>Actis du Jeudi : <a href="les_actis.php">ça se passe là
                        </a></p>
                    <p>Défi n°4 en cours : <a href="les_actis.php">plus d'infos ici
                        </a></p>

                </div>
            </div>
        </section>

        <!--============================== accueil_video ====================================-->


        <section class="accueil_video">
            <div class=video_video>
                <img id="buton-player" onclick="video_popup()" src="images/button-player.jpg">
                <img src="https://placehold.it/400x400">
            </div>
            <img id="tenture" src="images/Tenture.png">
        </section>

        <?php include_once "includes/footer.php" ?>
    </div>
</body>

<script>
    function retour_accueil() {
        $('#blur').css("filter", "blur(0)");
        $("#video_popup").css("opacity", "0");
        setTimeout(function() {
            $("#video_popup").css("z-index", "-1");

        }, 1000)();

    }

    function video_popup() {
        $('#blur').css("filter", "blur(20px)");
        $("#video_popup").css("z-index", "2");
        $("#video_popup").css("opacity", "1");

    }
</script>

</html>