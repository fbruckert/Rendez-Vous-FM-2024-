<?php
/*
// démarrage de la session php, pour stocker des variables
session_start();

// redirection si utilisateur non logué
if ($_SESSION['login']!=1 ) {
	session_destroy();
	// redirection vers index
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}
*/
?>

<!DOCTYPE HTML>
<!--
-->
<html>
<head>
	<title>Formulaire Validé</title>
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
		<div class="w3-container w3-half">
		<h5 class="w3-bottombar w3-border-purple">Formulaire Validé</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 60px;">
			<!-- Information -->
		</div>
  </div>


	<!-- INSERTION DES DONNEES PAR JAVASCRIPT -->
  <div id="display" class="w3-row w3-margin-left w3-half" style="padding-top: 50px;">
	</div>

  <!-- SCRIPTS LANCER L'ENREGISTREMENT DANS FILEMAKER -->
	<script>

		// FONCTION GET

		// FONCTION AFFICHAGE
		function datas_display() {
			// le result est transmis par l'URL -->> recupération
			let urlParams = new URLSearchParams(window.location.search);
			let result_text = urlParams.get('result');
			result = JSON.parse(result_text);

			console.log(result);

			var display = '<h5>'+ result.result_info + '</h5>';

			var div = document.getElementById("display");
			div.innerHTML = display;

		};
	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	<!-- SCRIPTS LANCES AU CHARGEMENT DE LA PAGE-->
	<script type="text/javascript">
		document.onload = datas_display();
	</script>

	</body>
</html>
