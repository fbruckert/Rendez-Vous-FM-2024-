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
	<title>Formulaire</title>
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
		<h5 class="w3-bottombar w3-border-purple">Formulaire de Contact</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 60px;">
			<!-- Information -->
		</div>
  </div>

	<!-- FORMULAIRE DE CONTACT -->
	<div class="w3-card-4 w3-margin w3-half">
	  <div class="w3-container w3-green">
	    <h2>Contact Nouveau Client</h2>
	  </div>
	  <div id="contactForm" class="w3-container" >
	    <p>
	    <label class="w3-text-green"><b>Prénom</b><span class="w3-text-red"> *</span></label>
	    <input class="w3-input w3-border w3-sand" name="prenom" id="prenom" type="text" ></p>
			<span id="prenomErreur" class="w3-text-red"></span>
	    <p>
	    <label class="w3-text-green"><b>Nom</b><span class="w3-text-red"> *</span></label>
	    <input class="w3-input w3-border w3-sand" name="nom" id="nom" type="text" ></p>
			<span id="nomErreur" class="w3-text-red"></span>
	    <p>
			<p>
			<label class="w3-text-green"><b>Email</b><span class="w3-text-red"> *</span></label>
			<input class="w3-input w3-border w3-sand" name="email" id="email" type="text" ></p>
			<span id="emailErreur" class="w3-text-red"></span>
			<p>
			<p>
			<label class="w3-text-green"><b>Note</b></label>
			<textarea rows="3" class="w3-input w3-border w3-sand" name="note" id="note" type="text"></textarea></p>
			<p>
	    <button class="w3-btn w3-green" onclick="validationForm()">Validation</button></p>
			<p class="w3-right-align"><span class="w3-text-red">* </span> champs obligatoires</p>
	  </div>
	</div>


  <!-- SCRIPTS LANCER L'ENREGISTREMENT DANS FILEMAKER -->
	<script>
	// FONCTION GET = envoi des paramètres vers FileMaker
	function datas_get() {
		 var prenom = document.getElementById("prenom").value;
		 var nom = document.getElementById("nom").value;
		 var email = document.getElementById("email").value;
		 var note = document.getElementById("note").value;
		 var param = '<prenom>' + prenom + '</prenom>' + '<nom>' + nom + '</nom>' + '<email>' + email + '</email>' + '<note>' + note + '</note>';
		 // AJAX QUERY
		 var xhttp = new XMLHttpRequest();
		 // appel
		 var url = 'fm_formulaire_validation.php?param='+ param;
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
						// Redirection après Enregistrement FileMaker
						window.location.href = 'formulaire_valide.php';
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
			};
	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	<!-- SCRIPTS UTILITAIRES DE LA PAGE-->
  <script type="text/javascript">

		function validationForm() {
		  var prenom = document.getElementById("prenom").value;
		  var nom = document.getElementById("nom").value;
		  var email = document.getElementById("email").value;
		  var prenomErreur = document.getElementById("prenomErreur");
		  var nomErreur = document.getElementById("nomErreur");
		  var emailErreur = document.getElementById("emailErreur");
		  var isValid = true;

		  // RAZ error messages
		  prenomErreur.textContent = "";
		  nomErreur.textContent = "";
		  emailErreur.textContent = "";

		  // Validation Prénom
		  if (prenom === "") {
		    prenomErreur.textContent = "Le Prénom est Obligatoire";
		    isValid = false;
		  }
		  // Validation Nom
		  if (nom === "") {
		    nomErreur.textContent = "Le Nom est Obligatoire";
		    isValid = false;
		  }
		  // Validation Email
		  if (email === "") {
		    emailErreur.textContent = "L'Email est Obligatoire";
		    isValid = false;
		  } else if (!/\S+@\S+\.\S+/.test(email)) {
		    emailErreur.textContent = "Email au format incorrect";
		    isValid = false;
		  }
			// DONNEES VALIDEES = Lancement du Script FileMaker
			if ( isValid == true) {
					datas_get();
			}
		  return;
		}

	</script>

	</body>
</html>
