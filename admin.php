<?php session_start();?>
<?php require_once("includes/Database.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['login'])) { // Form has been submitted.
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
			$query = "SELECT id, username, nom_complet ";
			$query .= "FROM users_admin ";
			$query .= "WHERE username = '{$username}'";
			$query .= "AND hashed_password = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_name'] = $found_user['nom_complet'];
				$_SESSION['groupe'] = 'A';
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>Sacc :: Gestion de la centrale d'achat</title>
<link rel="stylesheet" href="stylesheets/reset.css"/>
<link rel="stylesheet" href="stylesheets/style.css" />
<link rel="stylesheet" href="stylesheets/invalid.css"/>	
<script type="text/javascript" src="javascripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="javascripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="javascripts/facebox.js"></script>
<script type="text/javascript" src="javascripts/jquery.wysiwyg.js"></script>
</head>
  
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<span class="appli-name">SACC - CACM </span><br />
				<h1>Gestion des Commandes des Produits</h1>
				
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				<?php if (!empty($message)) { ?>
					<div class="notification error png_bg">
					  <div>
				      <?php echo  $message; ?>
		         <?php if (!empty($errors)) { display_errors($errors); } ?>
				    </div>
				  </div>
				  <?php } ?>
				<form action="admin.php" method="POST" focus="username">
			
				
					<div class="notification information png_bg">
						<div>
							Entrez vos coordonnées pour se connecter
						</div>
					</div>
					
					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="username" id="username" autocomplete="off"/>
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name="password" id="password" autocomplete="off"/>
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" name="login" value="Se Connecter" />
					</p>
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
  </body>
</html>
