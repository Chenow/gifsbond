<?php session_start();
include_once 'includes/connexion_bdd.php';
if (isset($_COOKIE["session_id_orgif"])) {
    $sessionID = $_COOKIE["session_id_orgif"];
    $sql = "SELECT carte1, carte2 from session_personnelle where sessionID = '$sessionID';";
    $cartes = mysqli_fetch_row(mysqli_query($conn, $sql));
    $carte1 = $cartes[0];
    $carte2 = $cartes[1];
}
?>

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
    <link rel="stylesheet" href="css/ta_main.css" />

    <!-- données annexes -->
    <title>GIFSBOND</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />

</head>


<body>

    <?php include_once 'includes/navigation.php' ?>

    <section>
        <div class="text_explicatif">
            <p>
                Vous connaissez probablement Casino Royale 🎥 🥷. En tout cas j’espère pour vous. Et parce qu’il est incroyable❤️‍🔥, Gifs Bond vous propose une partie de poker à suspens digne du film, mais grandeur campus (grandeur nature c’était trop petit 🤏) !! Il vous suffit d’aller tirer votre main sur notre site internet au début de la semaine. Une carte sera révélée chaque jour sur insta ou FB🃏, jusqu’au vendredi, ou celui qui possède la meilleure main remportera une belle récompense ! 🎁 Pour voir ta main, il suffit de se connecter.
            </p>
        </div>

        <br>
        <div class="cartes_container">
            <img src="png_poker/<?php echo "$carte1" ?>.png">
            <img src="png_poker/<?php echo "$carte2" ?>.png">
    </section>

    <?php include_once "includes/footer.php" ?>


</body>

</html>