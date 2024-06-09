<?php
# Toutes les pages qui accèdent à la base de données FileMaker doivent appeler dbaccess.php pour voir les données.
include 'php/dbconnect.php';
?>

<!DOCTYPE HTML>
<!--
-->
<html>
<head>
	<title>Login</title>
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
		<h5 class="w3-bottombar w3-border-purple">Login</h5>
	  </div>


	<!-- FORMULAIRE DE LOGIN -->
	<div class="w3-row w3-margin-left">
		<div class="w3-quarter w3-margin-left" style="padding-top: 100px;">
			<!-- login et mdp -->
	  <div id="loginForm" class="w3-container" >
	    <input class="w3-input w3-border w3-margin-bottom" id="login" type="text" name="name" placeholder="Login" />
			<span id="loginErreur" class="w3-text-red"></span>
	    <input class="w3-input w3-border" id="password" type="password" name="password" placeholder="Mot de Passe" />
			<span id="passwordErreur" class="w3-text-red"></span>

	    <button id="submitBtn" class="w3-btn w3-purple w3-margin-top" onclick="validation_utilisateur()">Log In</button></br>
	  </div>
		</div>
	</div>
	<h4 id="alert" class="w3-text-red w3-margin w3-padding-24">
	</h4>


	<!-- GESTION VALIDATION UTILISATEUR -->

	<!-- +++ TRES IMPORTANT ++++ GESTION A GERER DE MANIERE CACHE SUR UN SERVEUR NODE.JS -->

	<script type="text/javascript">

	var result;

	function validation_utilisateur () {
				// DEFINITION DES PARAMETRES
				var login = document.getElementById("login").value;
				var password = document.getElementById("password").value;
				var param_value = '<login>' + login + '</login>' + '<mdp>' + password + '</mdp>';

				// VARIABLES D'APPEL DataAPI
				var url = sessionStorage.getItem("url");
				var request = "/fmi/data/vLatest/databases/RendezVousFM_FB_demo/layouts/php_datas_get/script/php_login" ;
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
						//console.log(response_json);
						json_result = response_json.response.scriptResult;
						result = JSON.parse(json_result);
						console.log(result);


						// TEST SI UTILISATEUR VALIDE
						//var autorisation = result;
						console.log(result.result_log);
						if (result.result_log == 'valide' ) {
							//  Utilisateur VALIDE
							sessionStorage.setItem("nom_utilisateur", result.nom_utilisateur);
							sessionStorage.setItem("classe_acces", result.classe_acces);
							// Validation Autorisation Acces
							sessionStorage.setItem("Autorisation_acces", "valide");
							document.location = 'index_final.php';
						} else {
							// Utilisateur NON VALIDE
							// effacement du token stocké
							sessionStorage.clear();
							display = document.getElementById("alert");
							display.innerHTML = "Utilisateur NON AUTORISE";
						}

					})
					.catch((error) => {
						console.error(error);
						alert ('Erreur Requête Fetch() - Token ?');
						});

			};

	</script>

<script>
// script pour gérer la validation avec la touche return du clavier
var input = document.getElementById("password");
input.addEventListener("keyup", function(event) {
	if (event.keyCode === 13) {
	 event.preventDefault();
	 document.getElementById("submitBtn").click();
	}
});
</script>

<!-- SCRIPTS UTILITAIRES DE LA PAGE-->
<script type="text/javascript">

	function validationForm() {
		var login = document.getElementById("login").value;
		var password = document.getElementById("password").value;
		var loginErreur = document.getElementById("loginErreur");
		var passwordErreur = document.getElementById("passwordErreur");
		var isValid = true;

		// RAZ error messages
		loginErreur.textContent = "";
		passwordErreur.textContent = "";

		// Validation Prénom
		if (login === "") {
			loginErreur.textContent = "Le Login est Obligatoire";
			isValid = false;
		}
		// Validation Nom
		if (password === "") {
			passwordErreur.textContent = "Le Password est Obligatoire";
			isValid = false;
		}

		// DONNEES VALIDEES = Lancement du Script FileMaker
		if ( isValid == true) {
				datas_get();
		}
		return;
	}

</script>



<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
<script src="js/w3_scripts.js"></script>

	</body>

</html>
