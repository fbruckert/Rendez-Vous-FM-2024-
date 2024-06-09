

<!DOCTYPE HTML>
<!--
-->
<html>
<head>
	<title>D3 Demo</title>
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

	<!-- INCLUSION DU CSS POUR D3.JS-->
	<link rel="stylesheet" type="text/css" href="d3/inspector.css">

	<!-- INCLUSION DE D3.JS -->
	<script src = "https://d3js.org/d3.v7.min.js"></script>

</head>
<body class="w3-light-grey">


	<!-- Navigation -->
	<?php include 'php/navigation.php'; ?>

	<!-- Fonctions pour Affichage SUNBURST D3.JS -->
  <!-- <script src="runtime.js"></script> -->
  <!-- <script src="d3/data.js"></script> -->
  <script src="d3/d3_function.js"></script>

	<!-- !PAGE CONTENT! -->
	<div class="w3-main" style="margin-left:300px;margin-top:43px;">
		<!-- TITLE -->
		<div class="w3-container w3-half">
		<h5 class="w3-bottombar w3-border-purple">D3.js Demo</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div id="svg_display" class="w3-margin w3-threequarter" style="padding-top: 20px;">
			<!-- SVG -->
		</div>
  </div>

	<!-- DIV SVG -->
	<div  class="w3-card-4 w3-margin">

	</div>


  <!-- SCRIPTS LANCER L'ENREGISTREMENT DANS FILEMAKER -->
	<script>
		// FONCTION GET
		function datas_get() {
					// VARIABLES D'APPEL DataAPI
					var url = sessionStorage.getItem("url");
					var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/layouts/php_datas_get/script/php_stats_annees_factures_d3" ;
					var param = '?script.param=' + 'static';
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
							console.log(result);

		 				 // APPEL D3 POUR CREATION SVG
		 				 data = result;
		 				 _chart(d3,data);

					  })
					  .catch((error) => {
							console.error(error);
							alert ('Erreur Requête Fetch() - Token ?');
							});
					};
	</script>

	<!-- SCRIPTS LANCES AU CHARGEMENT DE LA PAGE-->
	<script type="text/javascript">
		document.onload = datas_get();
	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>


	</body>
</html>
