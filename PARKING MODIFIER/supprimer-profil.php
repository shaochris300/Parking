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
		  include("connection.php");  ?>

	<body>
		<h2> Liste des utilisateurs </h2><br/>

		<?php

			$req5=$bdd->prepare('DELETE FROM attente WHERE id_uti = :id_uti');
			$req5->execute(array(
				'id_uti'=>$_GET['id_uti']));

			$req = $bdd->prepare('DELETE FROM utilisateur WHERE id_uti = :id_uti');
			$req->execute(array(
				'id_uti'=>$_GET['id_uti']));

			echo 'L\'utilisateur a été supprimer.<a href="liste-utilisateur.php">Retour à la liste d\'utilisateur</a>';
		?>
		</p>
	</body>
    <?php include("footer.php"); ?>
</html>
