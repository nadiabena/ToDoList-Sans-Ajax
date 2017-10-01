<?php

/**
 * Traitement pour ajouter une tâche dans la to do list.
 */
if(isset($_GET["tache"])){
	$tache = $_GET["tache"];

	$fichier = "todo.json";
	$json = file_get_contents($fichier); 	//récupérer le fichier: C'est un objet de 2 tableaux

	$contenufichier = json_decode($json, true);  //Ici, j'obtiens un tableau de 2 tableaux..   Pourquoi le true???

	$contenufichier["aFaire"][] = $tache;  //push

	$ecriture = json_encode($contenufichier);

	file_put_contents($fichier, $ecriture);
}


$fichier = "todo.json";

$json = file_get_contents($fichier);	//GET: open et read
$contenufichier = json_decode($json, true);

/**
 * Traitement qui permet d'archiver les tâches à faire.	
 */
if(!empty($_GET) && isset($_GET["tache_to_save"])){
	$tache_to_save = $_GET["tache_to_save"];

	$contenufichier["archive"][] = $tache_to_save;

	$i=0;
	foreach ($contenufichier["aFaire"] as $value) {
		if($value == $tache_to_save){
			break;
		}
		$i++;
	}

	array_splice($contenufichier["aFaire"],$i,1);

	$ecriture = json_encode($contenufichier);

	file_put_contents($fichier, $ecriture);		//Put: write, read and close
}

/**
 * Traitement qui permet de retirer un élément dans la table archive et de le remettre dans la table aFaire.
 */
if(!empty($_GET) && isset($_GET["tache_to_do"])){
	$tache_to_do = $_GET["tache_to_do"];

	$contenufichier["aFaire"][] = $tache_to_do;

	$i=0;
	foreach ($contenufichier["archive"] as $value) {
		if($value == $tache_to_do){
			break;
		}
		$i++;
	}

	array_splice($contenufichier["archive"],$i,1);

	$ecriture = json_encode($contenufichier);

	file_put_contents($fichier, $ecriture);
}



?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" media="screen" href="bootstrap/css/bootstrap.min.css">
	<title>To do List</title>
</head>
<body>

	<div id="myList" style="overflow: scroll; border:1px solid black; width: 350px; margin-top: 50px; padding-left: 50px;">

		<form action="" method="GET">
			<br/>
			<p><b> <u>A FAIRE</u> </b></p>
			<?php foreach ($contenufichier["aFaire"] as $value) { ?>
				<input class="class_tache_a_faire" type="checkbox" name="tache_to_save" value="<?=  $value ?>"> <?=  $value ?> <br>
			<?php } ?>

		  	<br/>
		  	<input type="submit" value="Enregistrer">

			<?php foreach ($contenufichier["archive"] as $value) { ?>
				<strike> <p style="color:gray"> <input type="checkbox" name="tache_to_do" value="<?=  $value ?>">  <?=  $value ?> </p> </strike> 
			<?php } ?>
		</form>
		<br/>
		<!-- <a href="formulaire.php"> <button class="btn btn-success">Ajouter une nouvelle tâche</button> </a> <br/><br/> -->

	</div>

	<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>

