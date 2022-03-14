<header>
    <nav>
        <div class="gauche_nav">
            <img src="images/logo_jeton.png">
            <li class="orgif_header"><a href="accueil.php">GIFS BOND</a></li>
        </div>
        <div class="droite_nav">
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="la_liste.php">La Plaquette</a></li>
                <li><a href="hotline_service.php">Hotline Service</a></li>
                <li><a href="les_actis.php">Les Actis</a></li>
                <li><a href="ta_main.php">Ta Main</a></li>
            </ul>
        </div>
        <div class="menu_btn">
            <div class="menu_btn_burger">
            </div>
        </div>
    </nav>

    <?php if (isset($_COOKIE["session_id_orgif"])) {
        $test_connexion =  "connexion_hidden";
    } else {
        $test_connexion = "connexion";
    } ?>

    <a href="includes/oauth_vr.php" id="<?php echo $test_connexion ?>">
        Connexion
    </a>

</header>

<style type="text/css">
    header {
        width: 100vw;
        height: 10vh;
        background-color: none;
        position: fixed;
        display: flex;
        flex-direction: row;
        z-index: 20;
        transition: all 0.5s;
        position: fixed;
    }

    nav {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    .gauche_nav {
        display: inline-block;
        height: 100%;
        margin-left: 20px;
        display: flex;
    }

    .gauche_nav img {
        height: 80%;
        width: auto;
        display: block;
        margin-top: auto;
        margin-bottom: auto;
    }

    .orgif_header {
        height: 100%;
        display: flex;
        align-items: center;
        padding-left: 10px;
        text-decoration: none;
    }

    .orgif_header a {
        text-decoration: none;
        color: honeydew;
        font-weight: 900;
        font-size: 30px;
        transition: all 0.5s;
    }

    .orgif_header a:hover {
        color: rgb(0, 192, 218);
        font-size: 35px;

    }

    .orgif_header a::after {
        content: '';
        width: 0px;
        height: 1px;
        display: block;
        background: rgb(0, 192, 218);
        transition: 300ms;
    }

    .orgif_header a:hover::after {
        width: 100%;
    }

    .droite_nav {
        display: inline-block;
        height: 100%;
        position: static;
        transition: all 0.5s;
    }

    .droite_nav ul {
        margin: 0;
        padding: 0;
        margin-right: 50px;
        height: 100%;
        list-style: none;
        display: flex;
        flex-flow: row wrap;
    }

    .droite_nav li {
        position: relative;
        bottom: 0;
        padding-left: 30px;
        height: 100%;
        display: flex;
        align-items: center;
        transition: all 0.3s;
    }

    .droite_nav li:hover {
        bottom: 4px;
    }

    .droite_nav li a {
        text-decoration: none;
        color: white;
        font-size: 20px;
        font-weight: 900;
        transition: all 0.5s;
    }

    .droite_nav li a:hover {
        color: rgb(0, 192, 218);
    }


    .droite_nav li a::after {
        content: '';
        width: 0px;
        height: 1px;
        display: block;
        background: rgb(0, 192, 218);
        transition: 300ms;
    }

    .droite_nav li a:hover::after {
        width: 100%;
    }

    /**=== burger ===*/

    .menu_btn {
        display: none;
        justify-content: center;
        align-items: center;
        width: 80px;
        height: 100%;
        cursor: pointer;
        transition: all 0.5s ease-in-out;
        right: 10px;
    }

    .menu_btn_burger {
        width: 50px;
        height: 6px;
        background: #fff;
        border-radius: 5px;
        transition: all .5s ease-in-out;
        box-shadow: 0 1px 3px rgba(22, 44, 71, 0.9);
    }

    .menu_btn_burger::before,
    .menu_btn_burger::after {
        content: "";
        position: absolute;
        width: 50px;
        height: 5px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(22, 44, 71, 0.9);
        transition: all .5s ease-in-out;


    }

    .menu_btn_burger::before {
        transform: translateY(-16px);
    }

    .menu_btn_burger::after {
        transform: translateY(16px);
    }

    /**=== burger_animation ===*/
    .menu_btn.open .menu_btn_burger {
        transform: translateX(50px);
        background: transparent;
        box-shadow: none;
    }

    .menu_btn.open .menu_btn_burger::before {
        transform: rotate(45deg) translate(-35px, 35px);
        box-shadow: none;

    }


    .menu_btn.open .menu_btn_burger::after {
        transform: rotate(-45deg) translate(-35px, -35px);
        box-shadow: none;

    }

    @media (max-width: 1070px) {

        .menu_btn {
            display: flex;
        }

        .droite_nav {
            position: absolute;
            top: 10vh;
            right: 0;
        }

        .droite_nav ul {
            flex-flow: column wrap;
            margin-right: 0;
            display: block;
        }

        .droite_nav ul li {
            padding-left: 0;
            background-color: rgba(22, 44, 71, 0.9);
            padding-left: 10px;
            padding-right: 10px;
        }

        .droite_nav li:hover {
            bottom: 0;
        }
    }

    #connexion {
        text-decoration: none;
        color: white;
        font-size: 25px;
        font-weight: 900;
        transition: all 0.5s;
        position: absolute;
        bottom: -88vh;
        right: 2vw;
        border: white 3px solid;
        padding: 5px 10px;
        border-radius: 20px;
        background-color: rgba(22, 44, 71, 0.9);

    }

    #connexion_hidden {
        display: none;
    }

    #connexion:hover {
        color: rgb(0, 192, 218);
    }
</style>

<script type="text/javascript">
    //test connexion pour cacher login

    //cacher la navbar si scroll 
    var position = 0;
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll < position) {
            compteur_menue_deroulant = 0;
            $('.droite_nav').css("top", "-60vh");
            $('.menu_btn').removeClass("open");
            $('header').css('background-color', "none");
        } else {
            compteur_menue_deroulant = 0;
            $('.droite_nav').css("top", "-60vh");
            $('.menu_btn').removeClass("open");
            $('header').css('background-color', "rgba(22, 44, 71, 0.9)");
        }
        position = scroll;
    });

    //dérouler le menue avec hamburger
    compteur_menue_deroulant = 0;
    $('.droite_nav').css("top", "-60vh");
    $('.menu_btn').click(function() {
        $('header').css('background-color', "rgba(22, 44, 71, 0.9)");
        compteur_menue_deroulant = compteur_menue_deroulant + 1;
        if (compteur_menue_deroulant % 2 == 0) {
            $('.droite_nav').css("top", "-60vh");
            $('.menu_btn').removeClass("open");
        } else {
            $('.droite_nav').css("top", "10vh");
            $('.menu_btn').addClass("open");
        }
    });
</script>