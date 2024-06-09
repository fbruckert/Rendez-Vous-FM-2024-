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
	<title>Factures Mois</title>
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
		<h5 class="w3-bottombar w3-border-purple">Factures Mois</h5>
	  </div>

  <div class="w3-row w3-margin-left">
		<div class="w3-margin-left" style="padding-top: 30px;">
			<div>
				<span><b>Important :</b></span></br>
				<span>Ordre des Données JSON : Cf Script php_facture_mois</span><br>
			</div>
			<!-- Sélecteurs Dropdown-->
			<div style="padding-top: 40px;">
				<select id="selection_mois" class="w3-button w3-white w3-border w3-border-purple w3-round-large"  onchange="datas_get(value)" >
				</select>
				<select id="selection_annee" class="w3-button w3-white w3-border w3-border-purple w3-round-large"  onchange="datas_get(value)">
				</select>
			</div>
		</div>
  </div>

	<!-- INSERTION DES DONNEES PAR JAVASCRIPT -->
	<div class="w3-container">
		<!-- Information Période Factures -->
		  <div id="display" class="w3-row w3-margin-left" style="padding-top: 30px;">
			</div>
		<!-- Table Factures -->
			<table id="table_display" class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
		  </table>
 </div>


  <!-- SCRIPTS POUR OBTENIR DONNEES FILEMAKER ET LES AFFICHER -->
	<script>
	// FONCTION GET
	function datas_get() {
		 // AJAX QUERY
		 var xhttp = new XMLHttpRequest();
		 // définition des paramètres
		 var mois = document.getElementById("selection_mois").value;
		 var annee = document.getElementById("selection_annee").value;
		 var param = '<mois>' + mois + '</mois>' + '<annee>' + annee + '</annee>';
		 // appel
		 var url = 'fm_factures_mois_get.php?param='+ param;
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
				 var response_text = xhttp.responseText;
				 // Déclaration du résultats en variable globale
				 result = JSON.parse(response_text);
				 console.log(result);
 				 // déselection des menus déroulants
 				 dropdownBlur();

				 // lancement de la fonction affichage des résultats
				 datas_display(result);
				}
			};
			xhttp.open("GET", url, true);
			xhttp.send();
			};

		// FONCTION AFFICHAGE
		function datas_display(datas) {
			// INFORMATION
			var text = '<p id="info_periode"><b>Factures du ' + result.dates_periodes.dat_initiale + ' au ' + result.dates_periodes.dat_finale + '</b></p>';
			var div = document.getElementById("display");
			div.innerHTML = text;

			// TABLE
			// cas où il n'y a pas de facture
			if (Object.keys(result.factures).length == 0) {
				var div = document.getElementById("table_display");
				div.innerHTML = '<p class="w3-text-red w3-margin-left">Il n\'y a aucune facture sur cette période</p>';
			}
			// cas où il existe des factures
			else {
			var table = '<tr class="w3-dark-grey"><th>Nom</th><th>Prénom</th><th>Date</th><th>Montant</th><th>Ville</th></tr>';
			for (var i = 0; i < Object.keys(result.factures).length; i++) {
				// extraction de la facture n de l'objet result
				var factureN = Object.values(result.factures)[i];
				// construction de la ligne de la table
				table = table + '<tr><td>' + factureN.nom + '</td><td>' + factureN.prenom + '</td><td>' + factureN.date_facture + '</td><td class="w3-text-deep-orange">' + factureN.montant + ' €' +'</td><td>' + factureN.ville + '</td></tr>';
			}
			var div = document.getElementById("table_display");
			div.innerHTML = table;

			// DECOMPTE FACTURES
			var text = document.getElementById("info_periode");
			var count = Object.keys(result.factures).length;
			var decompte = '</br><span class="w3-text-green"><b>'+ count +   ' Factures au Total</b></span>'
			text.innerHTML += decompte;
						}
		};

	</script>





  <!-- Fonction pour définir le menu déroulant avec les mois et fonction pour les déselectionner pour des questions esthétiques-->
	<script>
	  var moisDeLannee = ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
		var anneeDisplay = ["2021","2022","2023","2024"];
	  // Function to populate the dropdown menu
	  function creationDropdown() {
	    var select = document.getElementById("selection_mois");
	    for (var i = 0; i < moisDeLannee.length; i++) {
	      var option = document.createElement("option");
	      option.text = moisDeLannee[i];
	      option.value = i + 1; // Adding 1 because index starts from 0
	      select.appendChild(option);
	    }
			var select = document.getElementById("selection_annee");
			for (var i = 0; i < anneeDisplay.length; i++) {
				var option = document.createElement("option");
				option.text = anneeDisplay[i];
				option.value = anneeDisplay[i];
				if (anneeDisplay[i] === "2024") {
				    // définition de l'attribut 'selected'
				    option.setAttribute("selected", "selected");
				  }
				select.appendChild(option);
			}
	  }
		function dropdownBlur(){
			document.getElementById("selection_mois").blur();
			document.getElementById("selection_annee").blur();
		}

	</script>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	<!-- SCRIPTS LANCES AU CHARGEMENT DE LA PAGE-->
	<script type="text/javascript">
		document.onload = creationDropdown();
		document.onload = datas_get();
	</script>

	</body>
</html>
