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
    <link rel="stylesheet" href="css/les_actisv2.css" />

    <!-- données annexes -->
    <title>GIFSBOND</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />

</head>


<body>

    <?php include_once 'includes/navigation.php' ?>

    <section class="actis">
        <h1>Les activités aujourd'hui</h1>
        <div>
            <img src="images/page_toucan.png">
        </div>

    </section>

    <section class="defis">
        <h1>Les défis en continu</h1>
        <div>
            <p class="explication">Cette semaine, les GIFSBOND t'ont prévu tout un tas de défis ! Réalise les à n'importe quelle momement afin de gagner un maximum de jetons. Une récompense attend le gagnant ! Les défis arrivent un par un, la liste va souvent être mise à jour, stay tuned. Tu trouveras ci-dessous la liste des défis, bonne chance ! </p>
        </div>
        <div>
            <p>
                Le MI6 à besoin de nouveaux contacts ! Le premier d'entre vous qui arrive à ramener 5 nouveaux abonnés à notre compte insta remporte 100 jetons ! (Vous devez nous MP le nom des 5 lorsqu'ils se sont abonnés) <br><br>
            </p>
        </div>
    </section>
    <?php include_once "includes/footer.php" ?>

</body>

</html>