

<?php
# Connect to the datbase.
include ("php/dbconnect.php");
?>

<?php
  // lancement si paramètre fixé
	if ( isset($_GET['param']) ) {
			//Le mode de gestion par Exception est configuré par défaut
			//il n'est donc pas nécessaire de le préciser dans les options
			try {
				 # Execution du script avec extraction des paramètres
					$layout = 'php_datas_get';
					$script = 'php_formulaire';
					$parameter = $_GET['param'];

					$request = $fm->newPerformScriptCommand($layout, $script, $parameter);
					# Execute the newPerformScriptCommand
					$result = $request->execute();

			} catch (FileMakerException $e) {
			    //Gestion des erreurs ayant pu survenir à n'importe quelle ligne
			    printf ('Erreur %d : %s ', $e->getCode(), $e->getMessage());
			}
			# Redirection après VALIDATION
			return;
		}
		// default si paramêtre non fixé
		echo 'paramètre manquant';

?>
