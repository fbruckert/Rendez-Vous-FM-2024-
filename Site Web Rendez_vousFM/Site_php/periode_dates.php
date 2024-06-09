<?php
// démarrage de la session php, pour stocker des variables
session_start();

// redirection si utilisateur non logué
if ($_SESSION['login']!=1 ) {
	session_destroy();
	// redirection vers index
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}

?>


<!DOCTYPE HTML>
<!--
-->
<html>
<head>
	<title>Périodes Dates</title>
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
		<h5 class="w3-bottombar w3-border-purple">Période Dates Factures</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 30px;">
			<!-- Processus -->
			 <div>
				 <span><b>Processus :</b></span><br>
				 <span>1- lancement en php du script FileMaker</span><br>
				 <span>2- récuperation en php du résultat dans FileMaker</span><br>
				 <span>3- parsing du résultat JSON et affichage</span><br>
			 </div>
			<button class="w3-button w3-purple" style="margin-top: 30px;" onclick="datas_get()">Lancement Requête</button>
		</div>
  </div>


  <!-- INSERTION DES DONNEES PAR JAVASCRIPT -->
  <div id="display" class="w3-row w3-margin-left" style="padding-top: 50px;">
	</div>


  <!-- SCRIPTS POUR OBTENIR DONNEES FILEMAKER ET LES AFFICHER -->
	<script>
	// FONCTION GET
	function datas_get() {
		 // AJAX QUERY
		 var xhttp = new XMLHttpRequest();
		 var param = 'paramètre_info';
		 var url = 'fm_periode_dates_get.php?param='+ param;
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
				 var response_text = xhttp.responseText;
				 // Déclaration du résultats en variable globale
				 result = JSON.parse(response_text);
				 console.log(result);

				 // affichage es résultats
				 datas_display(result);
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
			};

		// FONCTION AFFICHAGE
		function datas_display(datas) {
			var text = '<h5>Début de Facturation le ' + result['date_initiale'] + ' et Fin de Facturation le ' + result['date_finale'] + '</h5>';
			var div = document.getElementById("display");
			div.innerHTML = text;
		};
	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	</body>
</html>
