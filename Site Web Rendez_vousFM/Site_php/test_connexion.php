<?php
# Toutes les pages qui accèdent à la base de données FileMaker doivent appeler dbaccess.php pour voir les données.
#Syntax include ("PathToDBAccessFile")
include 'php/dbconnect.php';

?>

<!DOCTYPE HTML>
<!--
-->
<html>
<head>
	<title>Test Connexion</title>
	<meta name="author" content="Frédéric Bruckert" />
	<meta charset="UTF-8">
	<!-- INCLUSION DU CSS W3 SCHOOL -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
	</style>
</head>
<body class="w3-light-grey">

	<!-- Navigation -->
	<?php include 'php/navigation.php'; ?>

	<!-- !PAGE CONTENT! -->
	<div class="w3-main" style="margin-left:300px;margin-top:43px;">
		<!-- TITLE -->
		<div class="w3-container w3-third">
		<h5 class="w3-bottombar w3-border-purple">Test Connexion</h5>
	  </div>

		<div class="w3-container" style="padding-top: 100px;">
			<!-- Test Connexion -->
			<?php
			echo '<h3> Affichage des modèles de la Base RendezVousFM_FB_demo</h3><br>';
			$layouts = $fm->listLayouts();
			foreach ($layouts as $layout) {
					echo 'Nom du modèle : ' . $layout . '<br>';
			}
			echo '<h2 style="color: #00b33c"> Connexion OK</h2><br>';
			?>
		</div>
  </div>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	</body>
</html>
