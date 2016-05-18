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
		<h2> Numero de place à attribuer </h2><br/>
		<?php

		$numattente = $_GET['num_attente'];
		$compteur = 0;

		$req= $bdd->query('SELECT * FROM ATTENTE');
		while($donnees = $req->fetch())
		{
			if(isset($donnees['liste_attente']) && $donnees['liste_attente'] != -1 && $donnees['liste_attente'] != 0)
			{
				$compteur++;
			}
		}

		$compteur = $compteur +1;

		$req2 = $bdd->prepare('UPDATE ATTENTE SET liste_attente = :liste_attente WHERE num_attente = :num_attente');
		$req2->execute(array(
			'liste_attente'=>$compteur,
			'num_attente'=>$numattente));

		echo'La réservation a bien été ajouté à la liste d\'attente. <a href="reservation-attente.php">Retour aux attributions des places</a>';
		?>
		</form>

	</body>
    <?php include("footer.php"); ?>
</html>
