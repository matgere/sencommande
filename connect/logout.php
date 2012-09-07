<?php require_once("../includes/functions.php"); ?>
<?php
session_start();
// Détruit toutes les variables de session
$_SESSION = array();
// pour détruire complètement la session, on efface également
// le cookie de session.
if (isset($_COOKIE[session_name()])) {
   setcookie(session_name(), '', time()-42000, '/');
}
// on détruit la session.
session_destroy();

redirect_to("../login.php?logout=1");
?>
