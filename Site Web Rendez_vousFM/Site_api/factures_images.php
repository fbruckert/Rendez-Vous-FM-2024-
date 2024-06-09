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
	<title>Factures Images</title>
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
		<h5 class="w3-bottombar w3-border-purple">Factures et Photos Travaux</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 20px;">

			<!-- Bouton Déclenchement-->
			<div style="padding-top: 20px;">
				<button class="w3-button w3-purple" onclick="datas_get()">Récupération Données</button>
			</div>
		</div>
  </div>

	<div id="spinner" class="w3-container w3-threequarter w3-margin w3-padding-32 w3-center" style="display: none">
			 <img src="../img/spinner.gif" width="100px" height="100px">
  </div>

	<!-- INSERTION DES DONNEES PAR JAVASCRIPT -->
	<div class="w3-container">
		<!-- INFORMATION PERIODE FACTURES -->
			<div id="display" class="w3-row w3-margin-left" style="padding-top: 20px;">
			</div>
		<!-- TABLE FACTURE -->
			<table id="table_display" class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
		  </table>
  </div>



	<!-- SCRIPTS UTILITAIRES DE LA PAGE-->
	<script type="text/javascript">
			function showSpinner(){
				var spinner = document.getElementById("spinner");
				spinner.style.display = 'inline-block';
			};
			function hideSpinner(){
				var spinner = document.getElementById("spinner");
				spinner.style.display = 'none';
			};

			// Fonction pour connaitre l'ID DE LA FCATURE FILEMAKER
			 function displayRowId(event) {
					 // Obtention de l'ID de la ligne cliqué
					 var rowId = event.target.parentNode.id;
					 // DVisualisation de l'ID
					 alert("Cette ligne correspond à la Facture FileMaker : " + rowId);
			 }
	</script>



  <!-- SCRIPTS POUR OBTENIR DONNEES FILEMAKER ET LES AFFICHER -->
	<script>


		// FONCTION GET
		function datas_get(value) {
					// Spinner
					showSpinner();
					// DEFINITION DES PARAMETTRES A PARTIR DU PARAMTRE ENVOYE PAR LE BOUTON
					var param_value = value;

					// VARIABLES D'APPEL DataAPI
					var url = sessionStorage.getItem("url");
					var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/layouts/php_datas_get/script/php_factures_images" ;
					var param = '?script.param=' + param_value ;
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

							 // hide Spinner
							 hideSpinner();

							// Lancement de l'affichage des données
					    datas_display();
					  })
					  .catch((error) => {
							console.error(error);
							alert ('Erreur Requête Fetch() - Token ?');
							});
					};

		// FONCTION AFFICHAGE
		function datas_display(datas) {
			// INFORMATION
			var text = '<p id="info_periode"><b>Factures et Photos des Travaux</b></p>';
			var div = document.getElementById("display");
			div.innerHTML = text;

			// TABLE
			var table = '<tr class="w3-dark-grey"><th>Nom</th><th>Date</th><th>Montant</th><th>Ville</th><th>Photos</th></tr>';
			for ( facture in result ) {
				// extraction de la facture n de l'objet result
				var factureN = result[facture];
				// IDENTIFIANT FACTURES FILEMAKER
				var id = factureN.id_facture;
				// GESTION IMAGE
				var base64Image = factureN.img_b64;
				var img = new Image();
				img.src = "data:image/png;base64," + base64Image;

				table = table + '<tr id="' + id + '" onclick="displayRowId(event)"><td>' + factureN.nom + '</td><td>' + factureN.date_facture + '</td><td class="w3-text-deep-orange">' + factureN.montant + ' €' +'</td><td>' + factureN.ville + '</td><td><img src="'+ img.src + '"></td></tr>';
			}
			var div = document.getElementById("table_display");
			div.innerHTML = table;


		};
	</script>


	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>


	</body>
</html>
