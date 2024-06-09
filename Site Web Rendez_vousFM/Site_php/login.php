<?php
// démarrage de la session php, pour stocker des variables
session_start();

# permet de connaitre la page actuelle
$page = basename($_SERVER['PHP_SELF']);
?>

<?php
# Toutes les pages qui accèdent à la base de données FileMaker doivent appeler dbaccess.php pour voir les données.
#Syntax include ("PathToDBAccessFile")
include 'php/dbconnect.php';
?>

<?php
// TOUTES LES FONCTIONS DANS CE BLOC PHP PERMETTENT DE SECURISER L'ENTREE DES NOMS ET MOT DE PASSE, en évitant les insertions de code.
// remise à zéro des variables, et vérification des entrées de login et mot de passe.
$nameErr = $passwordErr = "";
$name = $password = "";
if ( ! empty( $_POST ) ) {
// nom
if (empty($_POST['name'])) {
	$nameErr = "Le Nom est obligatoire";
		}
else {
	$name = test_input($_POST['name']);
	// vérifie si le nom rentré ne contient que des lettre et des espaces
	if (!preg_match("/^[a-zA-Z]*$/",$name)) {
		$nameErr = "Seuls les Lettres sont autorisées";
				}
			}
// password
if (empty($_POST['password'])) {
	$passwordErr = "Le Mot de Passe est obligatoire";
	}
else {
	$password = test_input($_POST['password']);
	// vérifie que le password ne continet que des lettres et des nombres
	if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
		$passwordErr = "Seuls Lettres et Chiffres sont autorisés";
				}
			}
}

function test_input($data) {
	$data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
			}


?>

<?php
# verifie que la requete est en POST
# Vérification que les $_POST superglobals name et password sont remplies dés que le submit button est cliqué

if ( ! empty( $_POST ) ) {
if(!empty($_POST['name']) and !empty($_POST['password']))
	{
    # Recherche dans FileMaker dans la table Comptes , l'enregistrement avec name et password
		$username = $_POST['name'];
	  $password = $_POST['password'];
    $request = $fm->newFindCommand('php_comptes');
    $request->addFindCriterion('login', '=='.$username);
		$request->addFindCriterion('mdp', '=='.$password);
		$result = $request->execute();

	# Si aucun enregistrement trouvé, Afficher tous les Enregistrements pour éviter un renvoi d'erreur de FileMaker
	if ($fm->isError($result))
		{
	 	$request = $fm->newFindAllCommand('php_comptes');
    $result = $request->execute();
		}

	# Définit $found variable pour le nombre d'enregistrements trouvés Il ne doit y avoir que 1 enregistrement.
	$found = $result->getFoundSetCount();
	$records = $result->getRecords();
	$record= $records[0];
	if($found == 1)
		{
		$user = $record->getField('nom_utilisateur');
		$classe_acces = $record->getField('classe_acces');
		# Définit la supereglobale $_SESSION 'login' à 1 pour dire que le User est log in.
		# IMPORTANT : le controle de cette Variable sera fait au début de chaque page.
		# Use the header() method to redirect the user to the LoginSuccess.php page.
		$_SESSION['login']=1;
		$_SESSION['user']= $user;
		$_SESSION['classe_acces']= $classe_acces;

		# Redirection après login
		echo "<script type='text/javascript'> document.location = 'index_final.php'; </script>";
		exit;
		}
	else
		# Si plus d'un enregistrement est trouvé, la Variable de $_SESSION 'login' est 0.
		# Cela prévient l'accès au Page Protégées
		# Définit le message d'erreur $message variable pour dire au user que le Login et Mot de Passe sont incorrects.
		# Echo the $message in the html of the form.
		{
		$_SESSION['login']=0;
		$message = 'Login et Mdp INCORRECTS.';

		}
	}
}

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


 <div class="w3-row w3-margin-left">
		<div class="w3-quarter w3-margin-left" style="padding-top: 100px;">
			<!-- login et mdp -->
			<form id="laForm" name="laForm" class="w3-container" action="<?php echo $page; ?>" method="post">
					<input class="w3-input w3-border" type="text" name="name" placeholder="Login" />
					<span class="w3-text-red">&nbsp<?php echo $nameErr ?></span>
					<input class="w3-input w3-border" type="password" name="password" id="password" placeholder="Mot de Passe" />
					<span class="w3-text-red" >&nbsp<?php echo $passwordErr ?></span>
					<span class="w3-text-red" >&nbsp<?php echo $message ?> </span>
					<input id="submitBtn" class="w3-btn w3-purple w3-margin-top" type="submit" name="login" value="Log In"  />
			</form>
		</div>
  </div>


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

<!-- Fichier script w3 pour gérer les fonction responsive du menu -->
<script src="js/w3_scripts.js"></script>

	</body>

</html>
