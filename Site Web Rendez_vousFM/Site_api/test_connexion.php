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

		<div id="resultDiv" class="w3-container" style="padding-top: 100px;">
		</div>
  </div>

	<!-- Test Connexion -->
	<script>
	//    DEFINITION DE L'URL DE FILEMAKER SERVEUR ET DE LA DEMANDE DE CONNEXION
	// Variable d'appel du script
	var url = sessionStorage.getItem("url");
	var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/layouts" ;

	var url_requested = url + request ;

	var token = sessionStorage.getItem("token");

	// ENTETE
	var myHeaders = new Headers();
	myHeaders.append("Content-Type", "application/json");
	myHeaders.append("Authorization", "Bearer " + token );

	var requestOptions = {
		method: "GET",
		headers: myHeaders,
		redirect: "follow"
	};

	fetch( url_requested , requestOptions)
		.then((response) => response.json())
		.then((result) => {
			console.log(result);
			var list = '<p>Liste des Modèles :</p></br>';
			var layoutList = result.response.layouts;
			for (var i = 0; i < layoutList.length; i++ ) {
				list += '<li>' + layoutList[i].name +'</li>';
				}
				list += '<h2 style="color: #00b33c"> Connexion OK</h2><br>';
				list += '<h4>Token = ' + token + '</h4>';
				var display = document.getElementById("resultDiv");
				display.innerHTML = list ;
			})

		.catch((error) => {
			console.error(error);
			alert ('Erreur Requête Fetch() - Token ?');
				});

	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	</body>
</html>
