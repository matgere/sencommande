<?php session_start();?>
<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	
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
			$query = "SELECT users.id, username, Nom_complet, libelle ";
			$query .= "FROM roles, users ";
			$query .= "WHERE username = '{$username}'";
			$query .= "AND hashed_password = '{$hashed_password}' ";
			$query .= "AND roles.id = users.role_id ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_name'] = $found_user['Nom_complet'];
				$_SESSION['user_profil'] = $found_user['libelle'];
				if(($_SESSION['user_profil'] == "administrateur"))
				  redirect_to("../admin/");
				else
				  redirect_to("../public/acceuil.php");
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
		    $message = "Vous etes maintenant deconnecté";
		}
		$username = "";
		$password = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="../stylesheets/connection.css" rel="stylesheet" >
<title>CABINET MAITRE AVOCAT</title>
</head>
<body>
      <h1>CABINET ZMAITRE AVOCAT</h1><br /><br />
	<div id= "login">
        <form action="login.php" method="POST" focus="username">
    	<h2>Login <small>enter your credentials</small></h2>
    	<?php if (!empty($message)) {echo "<h4 class=\"alert\">" . $message . "</h4>";} ?>
		  <?php if (!empty($errors)) { display_errors($errors); } ?>
    	<p>
        	<label for="login">Login: </label>
            <input type="text" name="username" id="username" autofocus />
        </p>
        
        <p>
        	<label>Pass: </label>
            <input type="password" name="password" id="password"/>
        </p>
        
        <p>
        	<input type="submit" name="submit" id="submit" value="Se Connecter" />
        </p>
        
        </form>
	</div>
</body>
</html>
