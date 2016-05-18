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
		<h2> Les réservations en attentes </h2><br/>
		<?php
		if($_SESSION['nom'] == 'shao' && $_SESSION['prenom'] == 'christophe')
		{
			$verite = false;
			$req11 = 'SELECT * FROM attente';

			$req = $bdd->query($req11);
			while($donnees = $req->fetch())
			{
				if($donnees['num_place'] == NULL && $donnees['liste_attente'] == NULL)
				{
					$verite = true;
				}

			}

			if($verite == false)
			{
				echo'Aucune reservation en attente.<a href="reservation-encours.php">Retour au reservation valide</a>';
			}
			else
			{
			 echo'<table>
					<tr>
						<td>Nom</td>
						<td>Prenom</td>
						<td>Date début</td>
						<td>Date fin</td>
					</tr>';
	
					$req = $bdd->query($req11);
				while($donnees = $req->fetch())
				{
					if($donnees['num_place']== NULL && $donnees['liste_attente'] == NULL)
					{
						$req2 = $bdd->prepare('SELECT * FROM utilisateur WHERE id_uti=:id_uti');
						$req2->execute(array(
							'id_uti'=>$donnees['id_uti']));
						while($donnees2 = $req2->fetch())
						{
								echo '<tr><td>'.$donnees2['nom'].'</td>
										<td>'.$donnees2['prenom'].'</td>
										<td>'.$donnees['dateDebut'].'</td>
										<td>'.$donnees['dateFin'].'</td>
										<td><a href = "attribution-place.php?num_attente='.$donnees['num_attente'].'">Accepter</a></td>
										<td><a href = "reservation-refus.php?num_attente='.$donnees['num_attente'].'">Refuser</a></td>
				  					</tr>';
						}
					}
				}
				echo'</table>';
			}
		}
		else
		{
			$id_uti = $_SESSION['id_uti'];
			$verite = false;
			$null = NULL;

			$req = $bdd->prepare('SELECT * FROM attente WHERE id_uti=:id_uti');
			$req->execute(array(
				'id_uti'=>$id_uti));
			while($donnees = $req->fetch())
			{
				if($donnees['num_place'] == NULL && $donnees['liste_attente'] == NULL)
				{
					$verite = true;
				}

			}

			if($verite == false)
			{
				echo'Aucune reservation en attente.<a href="reservation-encours.php">Retour au reservation valide</a>';
			}
			else
			{
			 echo'<table>
					<tr>
						<td>Numéro de reservation</td>
						<td>Date début</td>
						<td>Date fin</td>
					</tr>';
					$req =$bdd->prepare('SELECT * FROM ATTENTE WHERE id_uti = :id_uti AND num_place IS NULL AND liste_attente IS NULL');
					$req->execute(array(
						'id_uti'=>$id_uti));
					while($donnees = $req->fetch())
					{
								echo '<tr><td>'.$donnees['num_attente'].'</td>
										<td>'.$donnees['dateDebut'].'</td>
										<td>'.$donnees['dateFin'].'</td>
				  					</tr>';
					}
					echo'</table>';
			}
		}
		?>
	</body>
    <?php include("footer.php"); ?>
</html>
