<script type="text/javascript">
	// PROTECTION PAGE

	// TEST SI EXISTENCE TOKEN , SINON REDIRECTION VERS PAGE LOGIN.PHP
	var token = sessionStorage.getItem("token");
	if (token == null || token == undefined ) {
		document.location = 'login.php';
	}
</script>


<!DOCTYPE HTML>
<!--
-->
<html>
<head>
	<title>Login ok</title>
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



	<!-- SCRIPTS UTILITAIRES DE LA PAGE-->
	<script type="text/javascript">

		var token = sessionStorage.getItem("token");
		var nom_utilisateur = sessionStorage.getItem("nom_utilisateur");
		var classe_acces = sessionStorage.getItem("classe_acces");

	</script>

	<!-- Navigation -->
	<?php include 'php/navigation.php'; ?>

	<!-- !PAGE CONTENT! -->
	<div class="w3-main" style="margin-left:300px;margin-top:43px;">
		<!-- TITLE -->
		<div class="w3-container w3-quarter">
		<h5 class="w3-bottombar w3-border-purple">Utilisateur Logué</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 30px;">
			<p>Bonjour <script type="text/javascript"> document.write(nom_utilisateur) </script> </p>
			<p>Vous êtes bien logué avec <span class="w3-text-red">nom_utilisateur :</span> <script type="text/javascript"> document.write(nom_utilisateur) </script></b></p>
			<p>Votre <span class="w3-text-red">classe_acces</span> est : <b><script type="text/javascript"> document.write(classe_acces) </script></b></p><br><br>

			<p class="w3-text-red"><b>Test au début de chaque Page Protégée avec Autorisation Acces Valide , sinon redirection Login</b></p>
		</div>
  </div>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	</body>
</html>
