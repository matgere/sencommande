<?php session_start();?>
<?php require_once("includes/Database.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = $password;
		
		if ( empty($errors) ) {
			// Check database to see if username and the hashed password exist there.
			$query = "SELECT users_membres.id, username, groupe, pack, nom_complet ";
			$query .= "FROM users_membres, membres ";
			$query .= "WHERE username = '{$username}'";
			$query .= "AND hashed_password = '{$hashed_password}' ";
			$query .= "AND membres.id = membre_id ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_name'] = $found_user['nom_complet'];
				$_SESSION['groupe'] = $found_user['groupe'];
				$_SESSION['pack'] = $found_user['pack'];
				redirect_to("cacm/");
			} else {
				// username/password combo was not found in the database
				$message = "La combinaison Username/password est incorrect.";
			}
		} else {
			if (count($errors) == 1) {
				$message = "Il y a 1 erreur sur le formulaire.";
			} else {
				$message = "Il y a " . count($errors) . " erreurs sur le formulaire.";
			}
		}
		
	} else { // Form has not been submitted.
		if(isset($_GET['logout']) && $_GET['logout']== 1){
		    $message = "Vous êtes maintenant déconnecté";
		}
		$username = "";
		$password = "";
	}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  	<title>Sacc - Gestion de la centrale d'achat</title>
  	<meta name="description" content="Demo of a Sliding Login Panel using jQuery 1.3.2" />
  	<meta name="keywords" content="sacc, cacm, centrale d'achat, achat a credit, commander, produits" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	

	<!-- stylesheets -->
  	<link rel="stylesheet" href="stylesheets/connexion.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="stylesheets/slide.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="stylesheets/accueil/bx_styles.css" type="text/css" media="screen" />
	
  	<!-- PNG FIX for IE6 -->
  	<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
	<!--[if lte IE 6]>
		<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
	<![endif]-->
	 
    <!-- jQuery - the core -->
	<script src="javascripts/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="javascripts/slide.js" type="text/javascript"></script>
  
  <script src="javascripts/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="javascripts/jquery.bxSlider.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#slider1').bxSlider();
  });
</script>
</head>

<body>
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
		
			<div class="left">
        &nbsp;
			</div>
			
			<div class="left">
				<h1>Sacc - Gestion CACM</h1>
				<p class="grey">Sacc - CACM - Renseignez vos coordonnées fournies par SACC pour acceder a votre espace membre</p>
			</div>
			<div class="left right">
				<!-- Login Form -->
				<form class="clearfix" action="index.php" method="post">
					<h1>Identification Membre</h1>
					<label class="grey" for="log">Login:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="pwd">Mot de Passe:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Se souvenir de moi</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Valider" class="bt_login" />
					<a class="lost-pwd" href="#">Mot de passe oublié?</a>
				</form>
			</div>
			
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Bonjour Invité !</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Se connecter</a>
				<a id="close" style="display: none;" class="close" href="#">Fermer</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

    <div id="container">
		<div id="content" style="padding-top:100px;">
		<a href="admin.php">ici</a>
		 <h1>SACC - Gestion de la centrale d'achat</h1>
			
			<div id="slider1">
  <div><img src="images/slider/riz.jpg" width="740" height="300" /></div>
  <div><img src="images/slider/huiles.jpg" width="740" height="300"/></div>
  <div><img src="images/slider/lait.jpg" width="740" height="300"/></div>
</div>

		  <p class="highlight">Ce portail vous permet d'effectuer des commandes en ligne de vos produits préférés. 
		  Pour commander, il suffit de renseigner votre login et votre mot de passe. 
		  Pour les non membres veuillez vous rapprochez de Sacc pour beneficez des avantages de la commande en ligne
		  </p>
		  
			
<p>
CACM est un cercle d’échange, de partage et d’entre-aide pour les membres qui pourront acheter, vendre, offrir des services etc. à leurs pairs.</p>

<p>Les objectifs de la CACM :
<ul>
<li>La vente à crédit de produits de consommation, d’entretien et divers</li>
Le membre dispose d’un crédit mensuel qui lui permet de se ravitailler chaque mois selon ses besoins. Le montant du crédit alloué varie selon les packs, ce qui laisse libre choix à la personne qui selon ses moyens va intégrer la catégorie qui lui correspond.
<li>La création d’un réseau de solidarité entre membres</li>
Créée pour répondre aux exigences des personnes en termes d’échange et de partage, Sacc servira de trait d’union pour faciliter les transactions membres-membres et/ou membres-fournisseurs. Les adhérents peuvent vendre leurs biens, demander et/ou offrir des services aux autres membres par l’intermédiaire de Sacc.
<li>La création et le développement d’entreprise</li>
Du moment qu’il n’ait pas permis à tous d’être membre du projet, il ait prévu de créer des GIES, Associations, etc. pour regrouper ces personnes pour leurs permettre non seulement d’intégrer la centrale à l’aide de leurs structures mais de favoriser leurs développements en leurs dotant d’outils nécessaires pour exercer des activités génératrices de revenus.
<li>La livraison à domicile</li>
Le client est roi, fait partie de notre quotidien c’est pourquoi Sacc se charge de livrer à domicile les produits commandés par les clients une fois disponible. Conscient de la difficulté à transporter des produits du lieu d’achat au domicile, Sacc se doit de supporter toutes charges qui fatigueraient le client.
</ul>
</p>
<h1>Vous ne viendrez plus chez nous par hasard!</h1>
		</div><!-- / content -->		
	</div><!-- / container -->
</body>
</html>
