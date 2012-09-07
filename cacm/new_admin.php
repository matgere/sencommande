<?php require_once("../includes/Database.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	include_once("../includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted
	    $nom_complet = addslashes($_POST['nom']);
	    $username = addslashes($_POST['username']);
	    $password = addslashes($_POST['password']);
	    
	    
	    $query = "INSERT INTO users_admin (nom_complet, username, hashed_password) 
			                  VALUES('$nom_complet', '$username', '$password')";
	    
	    $result = mysql_query($query, $connection) or die("error: " . mysql_error());
	    
	    $iduseradmin = mysql_insert_id();
			
			
	    if ($result){
			  
		   // redirect_to("show_produit.php?idproduit=$idproduit");
		   }
		}
?>
<?php include("../includes/header.php");?>
    <?php include('../includes/menu.php'); ?>
    	
      
      <div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
				<h3> Formulaire de saisie des administrateurs </h3>
				</div>
				<div class="clear"></div> <!-- End .clear -->
				<div class="content-box-content">
			      
			      <form action="new_admin.php" name="form" id="form" method="post" >
                    
                      
                      <label for="id" id="group">Nom Complet:</label>
                      <input class="text-input small-input" type="text" name="nom" id="nom" autocomplete="off" />
                      <br />
                      
                      <label for ="login">Login:</label>
                      <input class="text-input small-input" type="text" name="username" id="username" autocomplete="off"/>
                      <br />
                      
                      <label for ="password">Mot de passe :</label>
                      <input class="text-input small-input" type="password" name="password" id="password" autocomplete="off"/>
                      <br />   
              
                      
                   <br />
                  <input class="button" type="submit" name="submit" value="Valider">
                  <a href="#">
                    <input class="button" type="button" name="reset" value="Quitter sans enregistrer"></a>
                  </form>
                  
			  </div>
		</div>
			
			<div class="clear"></div> <!-- End .clear -->

<?php include('../includes/footer.php')?>

