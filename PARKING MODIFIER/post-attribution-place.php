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
		$id_reservation = $_GET['id_reservation'];
		$numplace = $_POST['numplace'];
		$statut = 1;


		$req2 = $bdd->prepare('UPDATE reservation SET num_place = :num_place WHERE id_reservation = :id_reservation');
		$req2->execute(array(
				'num_place'=> $numplace,
				'id_reservation'=> $id_reservation));

		echo 'L\'attribution de la place a été faite. <a href="reservation-attente.php">Retour aux attributions des places</a>';
		?>

	</body>
    <?php include("footer.php"); ?>
</html>
