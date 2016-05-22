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
        <h2> Reservation en cours </h2>
        <?php


        $numattente = $_GET['id_reservation'];
        $numplace = $_GET['num_place'];
        $valeur = -1;
        $valeur2 = 0;
        $valeur3 = 1;


        $req = $bdd->prepare('UPDATE reservation SET liste_attente = :liste_attente WHERE id_reservation = :id_reservation');
        $req->execute(array(
            'liste_attente'=>$valeur,
            'id_reservation'=>$numattente));

        $req2 = $bdd->prepare('UPDATE reservation SET liste_attente = :liste_attente, num_place = :num_place WHERE liste_attente = :liste_attentee');
        $req2->execute(array(
            'liste_attente'=>$valeur2,
            'num_place'=>$numplace,
            'liste_attentee'=>$valeur3));

        $compteur = 1;

        $req3 = $bdd->query('SELECT * FROM reservation ORDER BY liste_attente ASC');
        while($donnees3 =$req3->fetch())
        {
            if(isset($donnees3['liste_attente']) && $donnees3['liste_attente'] != -1 && $donnees3['liste_attente'] != 0)
            {
                $req4 = $bdd->prepare('UPDATE reservation SET liste_attente =:liste_attente WHERE id_reservation = :id_reservation');
                $req4->execute(array(
                    'liste_attente'=>$compteur,
                    'id_reservation'=>$donnees3['id_reservation']));

                $compteur++;
            }
        }


        echo'La place a été libérer.<a href="reservation-encours.php">Retour aux réservations</a>';
        
        ?>
        </table>
    </body>

    <?php include("footer.php"); ?>
</html>