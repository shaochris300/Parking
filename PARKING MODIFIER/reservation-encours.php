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
    <?php
     if($_SESSION['nom'] == 'shao' && $_SESSION['prenom'] == 'christophe')
        {
        ?>
        <h2> Reservation en cours </h2>
        <table>
            <tr>
                <td>Numero de la place</td>
                <td>Nom - Prenom</td>
            </tr>
        <?php
            $req22 ='SELECT * FROM UTILISATEUR';
            
            $req = $bdd->query('SELECT * FROM reservation WHERE num_place IS NOT NULL AND liste_attente = 0 ORDER BY num_place ASC');
            while($donnees = $req->fetch())
            {
                    $req2 = $bdd->query($req22);
                    while($donnees2 = $req2->fetch())
                    {
                        if($donnees2['id_uti'] == $donnees['id_uti'])
                        {
                            echo'<tr>
                                    <td>'.$donnees['num_place'].'</td>
                                    <td>'.$donnees2['nom'].'  '.$donnees2['prenom'].'</td>
                                    <td><a href = "liberer-place.php?num_place='.$donnees['num_place'].'&id_reservation='.$donnees['id_reservation'].'">Liberer</a></td>
                                </tr>';
                        }
                    }
            }
        ?>
        </table>
        <br/>
        <table>
        <h2> Reservation en attente </h2>
        <tr>
            <td>Numero d'attente</td>
            <td>Nom - Prenom</td>
        </tr>

        <?php

        $req =$bdd->query('SELECT * FROM reservation WHERE liste_attente != -1 AND liste_attente != 0 ORDER BY liste_attente ASC');
        while($donnees = $req->fetch())
        {
            $req2 = $bdd->query($req22);
            while($donnees2 = $req2->fetch())
            {
                if($donnees2['id_uti'] == $donnees['id_uti'])
                {
                    echo'<tr>
                             <td>'.$donnees['liste_attente'].'</td>
                              <td>'.$donnees2['nom'].'  '.$donnees2['prenom'].'</td>
                              <td><a href = "modifier-place.php?id_reservation='.$donnees['id_reservation'].'">Modifier</a></td>
                         </tr>';
                }
            }
        }

            echo'</table>';
            ?>
        <br />
        <table>
        <h2> Historique des réservation </h2>
        <tr>
            <td>Numero de réservation</td>
            <td>Nom - Prenom</td>
            <td>Date de début</td>
            <td>Date de fin</td>
            <td>Numéro de place occupé</td>
        </tr>
        <?php

        $req = $bdd->query('SELECT * FROM reservation WHERE liste_attente = -1 ORDER BY num_place ASC');
        while($donnees = $req->fetch())
        {
            $req2 = $bdd->query($req22);
            while($donnees2 = $req2->fetch())
            {
                if($donnees2['id_uti'] == $donnees['id_uti'])
                {
                    echo'<tr>
                          <td>'.$donnees['id_reservation'].'</td>
                          <td>'.$donnees2['nom'].'  '.$donnees2['prenom'].'</td>
                          <td>'.$donnees['dateDebut'].'</td>
                          <td>'.$donnees['dateFin'].'</td>
                          <td>'.$donnees['num_place'].'</td>
                         </tr>';
                }
            }
        }

            echo'</table>';
        }
        else
        {
            $id_uti = $_SESSION['id_uti'];

        echo'<h2> Reservation en cours </h2>
        <table>
            <tr>
                <td>Numero de la place</td>
                <td>Numéro de réservation</td>
            </tr>';

            
            $req = $bdd->prepare('SELECT * FROM reservation WHERE id_uti = :id_uti AND liste_attente = 0 ORDER BY num_place ASC');
            $req->execute(array(
                'id_uti'=>$id_uti));
            while($donnees = $req->fetch())
            {
                    echo'<tr>
                            <td>'.$donnees['num_place'].'</td>
                            <td>'.$donnees['id_reservation'].'</td>
                        </tr>';
            }
        ?>
        </table>
        <table>
        <h2> Reservation en attente </h2>
        <tr>
            <td>Numero d'attente</td>
            <td>Numéro de réservation</td>
        </tr>

        <?php
            $req3 = $bdd->prepare('SELECT * FROM reservation WHERE id_uti = :id_uti AND num_place IS NULL AND liste_attente IS NOT NULL ORDER BY liste_attente ASC');
            $req3->execute(array(
                'id_uti'=>$id_uti));
            while($donnees3 = $req3->fetch())
            {
                     echo'<tr>
                        <td>'.$donnees3['liste_attente'].'</td>
                         <td>'.$donnees3['id_reservation'].'</td>
                     </tr>';
            }
            echo'</table>';
            ?>
        <table>
        <h2> Historique des réservation </h2>
        <tr>
            <td>Numero de réservation</td>
            <td>Date de début</td>
            <td>Date de fin</td>
            <td>Numéro de place occupé</td>
        </tr>
        <?php
            $req=$bdd->prepare('SELECT * FROM reservation WHERE id_uti = :id_uti AND liste_attente = -1 ORDER BY liste_attente ASC');
            $req->execute(array(
                'id_uti'=>$id_uti));
            while($donnees = $req->fetch())
            {
                  echo'<tr>
                        <td>'.$donnees['id_reservation'].'</td>
                       <td>'.$donnees['dateDebut'].'</td>
                       <td>'.$donnees['dateFin'].'</td>
                       <td>'.$donnees['num_place'].'</td>
                      </tr>';
            }
            echo'</table>';
            
        }
        ?>
    </body>

    <?php include("footer.php"); ?>
</html>