<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	$id = $_GET['id'];
	$query = "SELECT id, libelle
            FROM roles 
            WHERE id = '{$id}' ";
	$result_set = mysql_query($query);
	confirm_query($result_set);
	$row = mysql_fetch_array($result_set);
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
	  
		// perform validations on the form data
		$required_fields = array('role');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));
		
    $role = trim(mysql_prep($_POST['role']));
		if ( empty($errors) ) {
		  
			$query = "UPDATE roles set libelle ='{$role}' WHERE id= '{$id}'";
			$result = mysql_query($query, $connection);
			
			if ($result) {
	    
				$message = "Modification effectué avec succes.";
				redirect_to("show_role.php?id=$id");
			} 
			else {
				$message = "Echec lors de la validation.";
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
            <h3> Fiche de modification d'un rôle</h3>
            <form action="edit_role.php?id=<?php echo $id; ?>" name="form" id="form" method="post" >
                        
                <label for ="role">Rôle : </label>
                <input type="text" name="role" id="role" value="<?php echo $row['libelle']?>"/><br />
                        
                <input type="submit" name="submit" value= "Valider" onclick="return confirm('Voulez vous valider cet enregistrement')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="roles.php"><input type="reset" name="reset" value= "Quitter sans enregistrer"></a>
                
                </form>
            <div>
          </div>
        </section>
      </div> 
      <?php include("../includes/footer.php");?>
