<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
       <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="moncss.css" />
    <title>Site de reservation</title>
    <h1> MAISON DES LIGUES DE LORRAINE </h1>
    </head>

    <?php include("menu.php"); 
          include("connection.php");?>
    <body>
        <br />
        <?php
        $placea = $_POST['placea'];
        $placen = $_POST['placen'];
        $valeur = -2;

        $req = $bdd->prepare('UPDATE reservation SET liste_attente = :liste_attente WHERE liste_attente = :liste_attentee');
        $req->execute(array(
            'liste_attente'=> $valeur,
            'liste_attentee'=> $placen));

        $req2 = $bdd->prepare('UPDATE reservation SET liste_attente = :liste_attente WHERE liste_attente = :liste_attentee');
        $req2->execute(array(
            'liste_attente'=>$placen,
            'liste_attentee'=> $placea));

        $req3 = $bdd->prepare('UPDATE reservation SET liste_attente = :liste_attente WHERE liste_attente = :liste_attentee');
        $req3->execute(array(
            'liste_attente'=>$placea,
            'liste_attentee'=>$valeur));



        echo 'La place de la file d\'attente a été changer.<a href="reservation-encours.php">Retour aux réservations</a>';
        ?>
    </body>

    <?php include("footer.php"); ?>
</html>