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
	<title>Statistiques Facturation Années</title>
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
		<h5 class="w3-bottombar w3-border-purple">Statistiques Facturation Années</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 10px;">
			<div>
				<p><span class="w3-text-red"><b>Données Dynamiques</b></span> = calcul des statistiques à la volée</p>
				<p><span class="w3-text-red"><b>Données Statiques</b></span> = extraction de données pré calculées par Script Serveur</p>
			</div>
			<!-- Sélecteurs -->
			<div>
					<button class="w3-button w3-purple" style="margin-top: 30px;" onclick="datas_get('dynamic')">Données Dynamiques</button>
					<button class="w3-button w3-purple" style="margin-top: 30px;" onclick="datas_get('static')">Données Statiques</button>
					<button class="w3-button w3-pale-red" style="margin-top: 30px;" onclick="clear_datas()">Clear Datas</button>
			</div>
		</div>
  </div>

	<div id="spinner" class="w3-container w3-threequarter w3-margin w3-padding-32 w3-center" style="display: none">
			 <img src="../img/spinner.gif" width="100px" height="100px">
  </div>

	<!-- INSERTION DES DONNEES PAR JAVASCRIPT -->
	<div class="w3-container">
		<!-- Information Période Factures -->
		  <div id="display" class="w3-row w3-margin-left" style="padding-top: 50px;">
			</div>
		<!-- Table Factures -->
			<table id="table_display" class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white ">
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
					var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/layouts/php_datas_get/script/php_stats_annees_factures" ;
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
		function datas_display() {
			// cas où stat vides
			if (result === null) {
				var div = document.getElementById("table_display");
				div.innerHTML = '<p class="w3-text-red w3-margin-left">Statistiques non disponibles</p>';
				return ;
			}

			// TABLE
			var table = '<tr class="w3-dark-grey"><th>Année</th><th>Ville</th><th>Chiffre Affaires</th></tr>';
			// Boucle sur les Années
			for (var i = 0; i < Object.keys(result).length; i++) {
				// Année
				var année = Object.keys(result)[i];
				table = table + '<tr class="w3-orange"><td class="w3-left">' + année + '</td><td></td><td>Chiffres Affaires TOTAL = ' + result[année].ca_total_annee_display +'</td></tr>';
				// Boucle sur les villes de l'année
				for (var inc = 0; inc < Object.keys(result[année].stats_villes).length; inc++) {
					// extraction des données
					var ligneNom = Object.keys(result[année]['stats_villes'])[inc];
					var ligneVille = result[année]['stats_villes'][ligneNom];

					table = table + '<tr class=""><td></td><td>' + ligneVille.ville + '</td><td>' + ligneVille.montant +' € </td></tr>';
				}
			}
			var div = document.getElementById("table_display");
			div.innerHTML = table;

		};

		// CLEAR DATAS
		function	clear_datas (){
			result = null;
			datas_display();
		}

	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	<!-- SCRIPTS UTILITAIRES DE LA PAGE-->
  <script type="text/javascript">

	</script>

	</body>
</html>
