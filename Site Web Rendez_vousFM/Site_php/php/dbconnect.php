<?php
    /**
     * Ce fichier est en charge de créer et d'initialiser l'Object FilMaker
     * Cet objet permet de manipuler les datas FileMaker.
     * IL faut inclure ce fichier pour accéder à FileMaker par l'intermédiaire de PHP
     */

    # Inclusion API PHP de FileMaker / Auteur Romain Dunand - 1 More Thing
		# IMPORTANT
	  # DOCUMENTATION : https://www.1-more-thing.com/api-php-de-filemaker/
    require ('FileMakerAPI/autoloader.php');

    use airmoi\FileMaker\FileMaker;

    $options = [
        'errorHandling' => 'default',
        'locale' => 'fr',
        'prevalidate' => true,
        'dateFormat' => 'd/m/Y',
    ];
		# Création de l'Object Filemaker, avec la spécification de toutes les Property
		# $fm = new FileMaker( $nom_database, $host, $user, $password, $options);

    // RENSEIGNER L'URL DE FILEMAKER SERVEUR ICI ---->>>
            $fm = new FileMaker('RendezVousFM_FB_demo', 'http://172.20.20.2', 'web', 'web', $options);
?>
