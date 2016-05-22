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
        <table>
        <h2> Reservation en attente </h2>
        <tr>
            <td>Numero d'attente</td>
            <td>Nom - Prenom</td>
            <td>Confirmer le numéro d'attente</td>
            <td>Entrer un nouveau numéro de file d'attente</td>
        </tr>

        <?php
        $numattente = $_GET['id_reservation'];

        $req = $bdd->prepare('SELECT * FROM reservation WHERE id_reservation = :id_reservation');
        $req->execute(array(
            'id_reservation'=>$numattente));

        while($donnees = $req->fetch())
        {
            $req2 = $bdd->prepare('SELECT * FROM utilisateur WHERE id_uti = :id_uti');
            $req2->execute(array(
                'id_uti'=> $donnees['id_uti']));

            while($donnees2 = $req2->fetch())
            {
                  echo'<tr>
                        <td>'.$donnees['liste_attente'].'</td>
                        <td>'.$donnees2['nom'].'  '.$donnees2['prenom'].'</td>
                        <form method="post" action="post-modifier-place.php">
                           <td><input type="number" name="placea" maxlength="2" value="'.$donnees['liste_attente'].'"/></td>
                           <td><input type="number" name="placen" maxlength="2"/></td>
                           <td><input type="submit" value="valider"></td>
                        </form>
                      </tr>';
            }
        }
            echo'</table>';
        ?>
    </body>
    <?php include("footer.php"); ?>
</html>