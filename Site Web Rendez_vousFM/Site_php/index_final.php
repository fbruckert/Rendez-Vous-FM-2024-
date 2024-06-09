<?php
// démarrage de la session php, pour stocker des variables
session_start();

# permet de connaitre la page actuelle
$page = basename($_SERVER['PHP_SELF']);

// redirection si utilisateur non logué
if ($_SESSION['login']!=1 ) {
	session_destroy();
	// redirection vers index
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}

$user = $_SESSION['user'];
$login = $_SESSION['login'];
$classe_acces = $_SESSION['classe_acces'];
?>

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
			<p>Bonjour <?php echo $user ?> </p>
			<p>Vous êtes bien logué avec <span class="w3-text-red">nom_utilisateur</span> ( $_SESSION['user'] ) :<b> <?php echo $user ?> </b></p>
			<p>Votre <span class="w3-text-red">classe_acces</span> est ( $_SESSION['classe_acces'] ) : <b><?php echo $classe_acces ?> </b></p><br><br>

			<p class="w3-text-red"><b>Test au début de chaque Page Protégée que ( $_SESSION['login'] )  = 1 , sinon redirection Login</b></p>
		</div>
  </div>

	<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
	<script src="js/w3_scripts.js"></script>

	</body>
</html>
