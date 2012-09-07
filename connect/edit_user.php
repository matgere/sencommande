<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	
	$id = $_GET['id'];
  $query = "SELECT users.id as id, role_id, libelle, Nom_complet, fonction, email, username, hashed_password
            FROM roles, users 
            WHERE 
            roles.id = role_id
            AND users.id = '{$id}'";
	$result_set = mysql_query($query);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('nom','email','username', 'password', 'confirm');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30, 'confirm' =>30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
    
    $role_id = trim(mysql_prep($_POST['role_id']));
    $nom = trim(mysql_prep($_POST['nom']));
		$email = trim(mysql_prep($_POST['email']));
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = $password;

		if ( empty($errors) ) {
			$query = "UPDATE users set role_id = '{$role_id}', nom_complet = '{$nom}', email = '{$email}', username = '{$username}', hashed_password = '{$hashed_password}' WHERE id = '{$id}'";
			$result = mysql_query($query, $connection);
			
			if ($result) {
				$message = "Modification effectuée avec succes.";
				redirect_to("show_user.php?id=$id");
			} 
			else {
				$message = "Erreur lors de la validation.";
				$message .= "<br />" . mysql_error();
			}
		} 
		else {
			if (count($errors) == 1) {
				$message = "Il y a ume erreur sur le formulaire.";
			} else {
				$message = "Il y a " . count($errors) . " erreur(s) sur le formulaire.";
			}
		}
	} else { // Form has not been submitted.
		$nom = "";
		$email = "";
		$username = "";
		$password = "";
	}
?>
<?php include("../includes/header.php");?>
 <?php include('../includes/menu.php')?>
  
        <section id="page">
            <div class="container_12">
              <div class="grid_12">
                <div id="menu-cadre">
            <h3> Fiche de de modification d'un utilisateur</h3>
            <div id= "login">
                <?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
		            <?php if (!empty($errors)) { display_errors($errors); } ?> 
    <form action="edit_user.php?id=<?php echo $id; ?>" method="POST" focus="nom">
    	<p>
        	<label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" value="<?php echo $row['Nom_complet'];?>" />
      </p>
        
    	<p>
        	<label for="email">Email: </label>
            <input type="email" name="email" id="email" value="<?php echo $row['email'];?>" />
      </p>
        
    	<p>
        	<label for="login">Login: </label>
            <input type="text" name="username" id="username" value="<?php echo $row['username'];?>" />
      </p>
        
    	<p>
        	<label for="password">Mot de Passe: </label>
            <input type="password" name="password" id="password" value="<?php echo $row['hashed_password'];?>"/>
      </p>
        
    	<p>
        	<label for="confirm">Confirmez mot de passe: </label>
            <input type="password" name="confirm" id="confirm" value="<?php echo $row['hashed_password'];?>" />
      </p>
        
      <p>
        	<label for="role">Role: </label>
            <select name="role_id">
              <option value="<?php echo $row['role_id'];?>"><?php echo $row['libelle'];?></option>
              <?php
              $query = "SELECT id, libelle FROM roles ";
			        $result_set = mysql_query($query);
			        confirm_query($result_set);
			        while($liste = mysql_fetch_array($result_set)){
			        ?>
			        <option value="<?php echo $liste['id']?>"><?php echo $liste['libelle']; ?></option>
			        <?php
			        }
			        ?>
            </select>
      </p>
        
      <p>
        	<input type="submit" name="submit" id="submit" value="Valider" onclick="return confirm('Voulez vous valider les modifications')" />
        	<a href="users.php"><input type="submit" name="quitter" id="quitter" value="Quitter sans enregistrer" /></a>
      </p>
        </form>
            <div>
          </div>
      </div> 
        </section>
      <?php include("../includes/footer.php");?>
