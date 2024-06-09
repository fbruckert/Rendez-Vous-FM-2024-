<script type="text/javascript">
	// PROTECTION PAGE

	// TEST SI EXISTENCE Autorisation Valide , SINON REDIRECTION VERS PAGE LOGIN.PHP
	var acces = sessionStorage.getItem("Autorisation_acces");
	if (acces !== 'valide' ) {
		document.location = 'login.php';
	}
</script>


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
				 <span>1- lancement de la Requête DataAPI FileMaker avec Fetch()</span><br>
				 <span>2- récuperation du résultat du script FileMaker</span><br>
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
				// VARIABLES D'APPEL DataAPI
				var url = sessionStorage.getItem("url");
				var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/layouts/php_datas_get/script/php_periode_dates_facture" ;
				var param = '?script.param=' + 'parametre_non_necessaire';
				var url_requested = url + request + param ;

				// Récupération du TOKEN stocké
				var token = sessionStorage.getItem("token");

				// ENTETE DEFINITION
				var myHeaders = new Headers();
				myHeaders.append("Content-Type", "application/json");
				myHeaders.append("Authorization", "Bearer " + token );

				var requestOptions = {
				  method: "GET",
				  headers: myHeaders,
							};

				// FETCH FONCTION
				fetch( url_requested , requestOptions )
				  .then((response) => response.json())
				  .then((response_json) => {
				    console.log(response_json);
						json_result = response_json.response.scriptResult;
						result = JSON.parse(json_result);

						// Lancement de l'affichage des données
				    datas_display();
				  })
				  .catch((error) => {
						console.error(error);
						alert ('Erreur Requête Fetch() - Token ?');
						});
				};

		// FONCTION AFFICHAGE
		function datas_display() {
					var text = '<h5>Début de Facturation le ' + result.date_initiale + ' et Fin de Facturation le ' + result.date_finale + '</h5>';
					var div = document.getElementById("display");
					div.innerHTML = text;
				};
	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	</body>
</html>
