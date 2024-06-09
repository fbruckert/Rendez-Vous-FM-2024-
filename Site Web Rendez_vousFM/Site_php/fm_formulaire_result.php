

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
			    // Récupération d'un modèle
			    $layout = $fm->getLayout('php_datas_get');
			    // Récupération d’un enregistrement en 1 ligne
			    $record = $fm->newFindAnyCommand('php_datas_get')->execute()->getFirstRecord();
					// RECUPERATION DU RESULTAT
					$jsonresult =  $record->getField('JSON_RESULT');

			} catch (FileMakerException $e) {
			    //Gestion des erreurs ayant pu survenir à n'importe quelle ligne
			    printf ('Erreur %d : %s ', $e->getCode(), $e->getMessage());
			}

			# le str_replace permet de s'assurer que les guillemets du json sont corrects
			$jsonobjResult = str_replace ("&quot;", "\"" , $jsonresult);

			echo $jsonobjResult;
			return ;
		}
		// default si paramêtre non fixé
		echo 'paramètre manquant';


?>
