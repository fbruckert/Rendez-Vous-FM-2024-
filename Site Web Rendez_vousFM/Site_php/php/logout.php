<?php

// Détruit toutes les variables de session $_SESSION variable PHP et les variables de sesion JAVASCRIPT, et log out le user
// This also happens automatically when the browser is closed
session_start();
session_destroy();
//
echo "<script type='text/javascript'> sessionStorage.clear();</script>";
// redirection vers index
echo "<script type='text/javascript'> document.location = '../index.php'; </script>";

?>
