<?php session_start(); ?>

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
    <link rel="stylesheet" href="css/billeterie.css" />
    <script type="text/javascript" src="js/billeterie.js"></script>

    <!-- données annexes -->
    <title>GIFSBOND</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />

<body>
    <?php include_once 'includes/navigation.php' ?>


    <section class="billeterie_landing">
        <span>LA SOIRÉE DE L'ORGIF </span>
    </section>

    <!--============================== description_soiree =========================================-->

    <section class="description_soiree">

    </section>

    <!--============================== billeterie_soiree ==========================================-->

    <?php include_once "includes/popups_billeterie.php" ?>

    <section class="billeterie_soiree">

        <h1>B I L L E T E R I E</h1>

        <form action="includes/systeme_bdd.php" method="POST">
            <input type="text" name="prenom" placeholder="Prénom">
            <br>
            <input type="text" name="nom" placeholder="Nom">
            <br>
            <input type="text" name="adresse_mail" placeholder="Adresse Mail">
            <br>
            <button type="submit" name="submit">Réservation</button>
        </form>
    </section>

    <!--================================= infos_soiree ============================================-->

    <section class="infos_soiree">

    </section>

    <?php include_once "includes/footer.php" ?>

</body>

</html>