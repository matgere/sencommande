<?php session_start();?>
<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
	  
		// perform validations on the form data
		$required_fields = array('role');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
    $role = trim(mysql_prep($_POST['role']));
    
		if ( empty($errors) ) {
		  $sqlverif="select libelle from roles where libelle ='{$role}'";
      $resverif = mysql_query($sqlverif, $connection) or die(mysql_error());
      $nb = mysql_num_rows($resverif);
      if($nb > 0){
        $message = "Ce rôle existe deja.";
      }
      else{
			$query = "INSERT INTO roles (libelle)
			          VALUES ('{$role}')";
			$result = mysql_query($query, $connection);
			
			if ($result) {
	    
				$message = "Enregistrement effectué avec succes.";
			} 
			else {
				$message = "Echec lors de la validation.";
				$message .= "<br />" . mysql_error();
			}
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
		$role = "";
	}
?>
<?php include("../includes/header.php");?>
        <nav>
          <div class="content-wrapper">
            <?php include("../includes/menu.php"); ?>
          </div>
        </nav>
        <br />
        <section id="page"> 
          <?php if (!empty($message)) {echo "<p id=\"flash_notice\">" . $message . "</p>";} ?>
		      <?php if (!empty($errors)) { display_errors($errors); } ?> 
          <div class="content-wrapper">
            <div class="content-container">
            <h3> Fiche de creation d'un rôle</h3>
            <form action="new_role.php" name="form" id="form" method="post" >
                        
                <label for ="role">Rôle : </label>
                <input type="text" name="role" id="role"/><br />
                        
                <input type="submit" name="submit" value= "Créer" onclick="return confirm('Voulez vous creer ce Rôle')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="roles.php"><input type="reset" name="reset" value= "Quitter sans enregistrer"></a>
                
                </form>
            <div>
          </div>
        </section>
      </div> 
      <?php include("../includes/footer.php");?>
