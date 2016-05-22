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
		<h2> Réservation </h2><br/>

		<?php
		$id_uti = $_SESSION['id_uti'];
		$dated = $_POST['dated'];
		$datef = $_POST['datef'];

			$req = $bdd->prepare('INSERT INTO reservation(id_uti, dateDebut, dateFin) VALUES (:id_uti, :dateDebut, :dateFin)');
			$req -> execute(array(
				'id_uti'=> $id_uti,
				'dateDebut'=> $dated,
				'dateFin'=> $datef));

			echo 'Votre réservation a bien été prit en compte, veuillez attendre l\'acceptation de l\'admin. <a href="index.php">Retour à l\'accueil</a>';

		?>
		</p>
	</body>
    <?php include("footer.php"); ?>
</html>
