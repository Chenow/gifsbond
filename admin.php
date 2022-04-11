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
    <title>L'Orgif</title>
    <link href="images/logo_jeton.png" rel="icon" />
    <meta charset='utf-8' />

</head>

<body>
    <form action="systeme_bdd.php" method="POST">
        <input type="text" name="debut_destroy" placeholder="debut des commandes à supprimer">
        <br>
        <input type="text" name="fin_destroy" placeholder="fin des commandes à supprimer">
        <br>
        <input type="password" name="mdp" placeholder="mdp">
        <br>
        <button type="submit" name="submit">Modification bdd</button>
    </form>
</body>

</html>